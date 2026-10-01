<?php

namespace i3or1s\EFakture\Util;

use i3or1s\EFakture\Exception\ResourceUnavailable;
use i3or1s\EFakture\Exception\SefApiException;
use i3or1s\EFakture\Model\SEFStorageInterface;
use i3or1s\EFakture\ResourceStream\ResourceStreamInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

use function React\Async\await;

use React\Http\Browser;
use React\Http\Message\ResponseException;

use function React\Promise\all;

use React\Promise\Deferred;
use React\Stream\ReadableStreamInterface;
use RingCentral\Psr7\Response;

final class EFaktureApi
{
    public readonly Browser $browser;
    public readonly string $apiKey;
    public readonly string $rootUri;

    public function __construct(Browser $browser, string $apiKey, string $rootUri = 'https://demoefaktura.mfin.gov.rs/')
    {
        $this->browser = $browser;
        $this->apiKey = $apiKey;
        $this->rootUri = $rootUri;
    }

    /**
     * @param array<string, string|int> $queryParams
     *
     * @return array<string, string|int|bool>
     *
     * @throws ResourceUnavailable
     */
    public function getResource(EFakturaAPIRoutes $route, array $queryParams = [], string $accept = '*/*'): array
    {
        try {
            /** @var Response $response */
            $response = await($this->browser->get($this->uri($route, $queryParams), $this->headers(['accept' => $accept])));
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            if (is_array($decodedResponse)) {
                return $decodedResponse;
            }
        } catch (\Throwable $e) {
            throw self::failure($e);
        }

        return [];
    }

    /**
     * Fetches a resource without JSON-decoding the response body, for endpoints
     * that return raw content (e.g. the original UBL XML document).
     *
     * @param array<string, string|int> $queryParams
     *
     * @throws ResourceUnavailable
     */
    public function getRawResource(EFakturaAPIRoutes $route, array $queryParams = []): string
    {
        try {
            /** @var Response $response */
            $response = await($this->browser->get($this->uri($route, $queryParams), $this->headers(['accept' => '*/*'])));

            return $response->getBody()->getContents();
        } catch (\Throwable $e) {
            throw self::failure($e);
        }
    }

    public function streamResource(EFakturaAPIRoutes $route, ResourceStreamInterface $resourceStream): ResourceStreamInterface
    {
        if ($resourceStream->getStorageInterface()->isLockedForWriting()) {
            return $resourceStream;
        }
        // SEF answers 415 to some list endpoints (the exemption reasons) unless JSON is asked for.
        $promise = $this->browser->requestStreaming('GET', $this->uri($route, []), $this->headers(['accept' => 'application/json']));
        $defer = new Deferred();
        $promise->then(function (ResponseInterface $response) use ($resourceStream, $defer, $route) {
            $body = $response->getBody();
            assert($body instanceof StreamInterface);
            assert($body instanceof ReadableStreamInterface);

            $leftOver = '';
            $i = 0;

            $body->on('data', function ($chunk) use (&$leftOver, &$i, $resourceStream, $route) {
                ++$i;
                $compiledChunk = $leftOver.$chunk;
                preg_match_all('#(\{.*?\})#', $compiledChunk, $matches);
                $leftOver = preg_replace('#(\{.*?\},)#', '', $compiledChunk);

                foreach ($matches[0] as $match) {
                    $sefClass = $route->SEFObject();
                    $decodedResp = json_decode($match, true);
                    if (null === $decodedResp) {
                        continue;
                    }
                    try {
                        /** @var string[] $decodedResp */
                        /** @var SEFStorageInterface $sefObj */
                        $sefObj = new $sefClass(...array_values($decodedResp));
                        $resourceStream->getStorageInterface()->store([$sefObj]);
                    } catch (\Throwable) {
                    }
                }
            });

            $body->on('error', function (\Exception $e) {
                throw $e;
            });
            $body->on('close', function () use ($defer) {
                $defer->resolve(1);
            });
        }, function (\Exception $e) {
            throw $e;
        });
        await(all([$promise, $defer->promise()]));

        return $resourceStream;
    }

    /**
     * @param array<string, string|int> $queryParams
     * @param string[]                  $additionalHeaders
     *
     * @return array<string, string|int|bool>
     *
     * @throws ResourceUnavailable
     */
    public function sendResource(EFakturaAPIRoutes $route, string|ReadableStreamInterface $resource, array $queryParams = [], array $additionalHeaders = []): array
    {
        try {
            /** @var Response $response */
            $response = await($this->browser->post($this->uri($route, $queryParams), $this->headers($additionalHeaders), $resource));
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            if (is_array($decodedResponse)) {
                return $decodedResponse;
            }
        } catch (\Throwable $e) {
            throw self::failure($e);
        }

        return [];
    }

    /**
     * POSTs a JSON body (cancel, storno, company lookup, ...).
     *
     * @param array<string, mixed>      $payload
     * @param array<string, string|int> $queryParams
     *
     * @return array<string, mixed>
     *
     * @throws ResourceUnavailable
     */
    public function sendJson(EFakturaAPIRoutes $route, array $payload, array $queryParams = []): array
    {
        return $this->sendResource($route, json_encode($payload, JSON_THROW_ON_ERROR), $queryParams, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Streams an endpoint that answers with a JSON array of objects and hands each decoded
     * object to $onObject as it arrives, so large lists (the company registry) are never held
     * in memory. An exception thrown by $onObject stops the stream and is rethrown.
     *
     * @param callable(array<string, mixed>): void $onObject
     * @param array<string, string|int>            $queryParams
     *
     * @return int the number of objects handed over
     *
     * @throws ResourceUnavailable
     */
    public function streamJsonObjects(EFakturaAPIRoutes $route, callable $onObject, array $queryParams = []): int
    {
        try {
            /** @var ResponseInterface $response */
            $response = await($this->browser->requestStreaming('GET', $this->uri($route, $queryParams), $this->headers(['accept' => 'application/json'])));
        } catch (\Throwable $e) {
            throw self::failure($e);
        }

        $body = $response->getBody();
        assert($body instanceof ReadableStreamInterface);
        $splitter = new JsonArraySplitter();
        $count = 0;
        $done = new Deferred();

        $body->on('data', function (string $chunk) use ($splitter, $onObject, &$count, $done, $body): void {
            try {
                foreach ($splitter->push($chunk) as $json) {
                    $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
                    if (is_array($decoded)) {
                        $onObject($decoded);
                        ++$count;
                    }
                }
            } catch (\Throwable $e) {
                $done->reject($e);
                $body->close();
            }
        });
        $body->on('error', fn (\Throwable $e) => $done->reject(new ResourceUnavailable($e->getMessage(), 0, $e)));
        $body->on('close', fn () => $done->resolve(null));

        await($done->promise());

        return $count;
    }

    /**
     * @param array<string, string|int|null> $queryParams
     */
    private function uri(EFakturaAPIRoutes $route, array $queryParams): string
    {
        $uri = sprintf('%s/%s', rtrim($this->rootUri, '/'), trim($route->value, '/'));
        $query = http_build_query(array_filter($queryParams, static fn ($value): bool => null !== $value), '', '&', PHP_QUERY_RFC3986);

        return '' === $query ? $uri : sprintf('%s?%s', $uri, $query);
    }

    /**
     * @param array<string, string> $headers
     *
     * @return array<string, string>
     */
    private function headers(array $headers): array
    {
        return array_merge($headers, ['ApiKey' => $this->apiKey]);
    }

    private static function failure(\Throwable $e): ResourceUnavailable
    {
        if ($e instanceof ResourceUnavailable) {
            return $e;
        }
        if ($e instanceof ResponseException) {
            return SefApiException::fromResponse($e->getResponse()->getStatusCode(), (string) $e->getResponse()->getBody(), $e);
        }

        return new ResourceUnavailable($e->getMessage(), (int) $e->getCode(), $e);
    }
}
