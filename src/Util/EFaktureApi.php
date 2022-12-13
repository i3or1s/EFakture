<?php

namespace i3or1s\EFakture\Util;

use i3or1s\EFakture\Exception\ResourceUnavailable;
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
     * @return array<string, string|int|bool>
     *
     * @throws ResourceUnavailable
     */
    public function getResource(EFakturaAPIRoutes $route): array
    {
        try {
            $promise = $this->browser->get(
                sprintf('%s/%s', trim($this->rootUri, '/'), trim($route->value, '/')),
                [
                    'accept' => '*/*',
                    'ApiKey' => $this->apiKey,
                ]
            );
            /** @var Response $response */
            $response = await($promise);
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            if (is_array($decodedResponse)) {
                return $decodedResponse;
            }
        } catch (\Throwable $e) {
            throw new ResourceUnavailable($e->getMessage(), $e->getCode(), $e);
        }

        return [];
    }

    public function streamResource(EFakturaAPIRoutes $route, ResourceStreamInterface $resourceStream): ResourceStreamInterface
    {
        if ($resourceStream->getStorageInterface()->isLockedForWriting()) {
            return $resourceStream;
        }
        $promise = $this->browser->requestStreaming('GET', sprintf('%s/%s', trim($this->rootUri, '/'), trim($route->value, '/')), [
            'accept' => '*/*',
            'ApiKey' => $this->apiKey,
        ]);
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
                    try {
                        $decodedResp = json_decode($match, true);
                        if(null === $decodedResp) {
                            continue;
                        }
                        /** @var string[] $decodedResp */
                        /** @var SEFStorageInterface $sefObj */
                        $sefObj = new $sefClass(...array_values($decodedResp));
                        $resourceStream->getStorageInterface()->store([$sefObj]);
                    } catch (\Throwable $e) {
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
            $query = [];
            foreach ($queryParams as $name => $value) {
                $query[] = sprintf('%s=%s', $name, $value);
            }
            $promise = $this->browser->post(
                sprintf('%s/%s?%s', trim($this->rootUri, '/'), trim($route->value, '/'), implode('&', $query)),
                array_merge($additionalHeaders, [
                    'ApiKey' => $this->apiKey,
                ]),
                $resource
            );
            /** @var Response $response */
            $response = await($promise);
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            if (is_array($decodedResponse)) {
                return $decodedResponse;
            }
        } catch (ResponseException $e) {
            throw new ResourceUnavailable($e->getResponse()->getBody()->getContents(), $e->getCode(), $e);
        } catch (\Throwable $e) {
            throw new ResourceUnavailable($e->getMessage(), $e->getCode(), $e);
        }

        return [];
    }
}
