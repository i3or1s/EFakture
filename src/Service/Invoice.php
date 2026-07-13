<?php

namespace i3or1s\EFakture\Service;

use i3or1s\EFakture\Exception\ResourceUnavailable;
use i3or1s\EFakture\Model\CirInvoiceStatus;
use i3or1s\EFakture\Model\DocumentDirection;
use i3or1s\EFakture\Model\MiniInvoiceDto;
use i3or1s\EFakture\Model\PurchaseInvoicesDto;
use i3or1s\EFakture\Model\PurchaseInvoiceStatus;
use i3or1s\EFakture\Model\SalesInvoicesDto;
use i3or1s\EFakture\Model\SalesInvoiceStatus;
use i3or1s\EFakture\Model\SendToCir;
use i3or1s\EFakture\Model\SimplePurchaseInvoiceDto;
use i3or1s\EFakture\Model\SimpleSalesInvoiceDto;
use i3or1s\EFakture\UBL\Invoice as UBLInvoice;
use i3or1s\EFakture\Util\EFakturaAPIRoutes;
use i3or1s\EFakture\Util\EFaktureApi;
use i3or1s\EFakture\Util\XmlToArrayConverter;

use function React\Async\await;
use function React\Promise\Timer\sleep;

final class Invoice
{
    /**
     * Default delay between consecutive requests when retrieving multiple invoices, in seconds.
     * No official SEF rate limit is published; this is a conservative placeholder.
     */
    private const DEFAULT_THROTTLE_SECONDS = 0.2;

    /**
     * Default number of retries (after the initial attempt) on HTTP 429 before giving up.
     */
    private const DEFAULT_MAX_RETRY_ATTEMPTS = 3;

    /**
     * Base delay for exponential backoff on HTTP 429, in seconds (1s, 2s, 4s, ...).
     */
    private const RETRY_BASE_DELAY_SECONDS = 1.0;

    public function send(EFaktureApi $api, UBLInvoice $invoice): MiniInvoiceDto
    {
        $xmlInvoice = sprintf(
            '%s%s%s',
            '<?xml version="1.0" encoding="utf-8"?>',
            PHP_EOL,
            $invoice->invoice
        );
        /** @var array{InvoiceId: int|string, PurchaseInvoiceId: int|string, SalesInvoiceId: int|string} $response */
        $response = $api->sendResource(EFakturaAPIRoutes::SALES_INVOICE_UBL, $xmlInvoice, [
            'sendToCir' => SendToCir::AUTO,
            'requestId' => $invoice->invoice->ID->value->value,
        ], [
            'accept' => 'text/plain',
            'Content-Type' => 'application/xml',
        ]);

        return new MiniInvoiceDto((int) $response['InvoiceId'], (int) $response['PurchaseInvoiceId'], (int) $response['SalesInvoiceId']);
    }

    /**
     * Pulls the ids of invoices already existing on SEF for the given direction:
     * OUTBOUND for invoices this company sent, INBOUND for invoices this company received.
     */
    public function pull(EFaktureApi $api, DocumentDirection $direction, ?string $status = null, ?\DateTimeImmutable $dateFrom = null, ?\DateTimeImmutable $dateTo = null): SalesInvoicesDto|PurchaseInvoicesDto
    {
        $queryParams = array_filter([
            'status' => $status,
            'dateFrom' => $dateFrom?->format(\DateTimeInterface::ATOM),
            'dateTo' => $dateTo?->format(\DateTimeInterface::ATOM),
        ], static fn ($value): bool => null !== $value);

        if (DocumentDirection::OUTBOUND === $direction) {
            /** @var array{SalesInvoiceIds?: int[]} $response */
            $response = $api->sendResource(EFakturaAPIRoutes::SALES_INVOICE_IDS, '', $queryParams, [
                'accept' => 'text/plain',
            ]);

            return new SalesInvoicesDto($response['SalesInvoiceIds'] ?? []);
        }

        /** @var array{PurchaseInvoiceIds?: int[]} $response */
        $response = $api->sendResource(EFakturaAPIRoutes::PURCHASE_INVOICE_IDS, '', $queryParams, [
            'accept' => 'text/plain',
        ]);

        return new PurchaseInvoicesDto($response['PurchaseInvoiceIds'] ?? []);
    }

    /**
     * Retrieves full invoice status/metadata from SEF for the given ids.
     * Pass a single-element array to fetch just one invoice.
     *
     * Requests are throttled and retried with backoff on HTTP 429, since SEF does not
     * publish an official rate limit for this endpoint.
     *
     * @param int[] $invoiceIds
     *
     * @return array<int, SimpleSalesInvoiceDto|SimplePurchaseInvoiceDto>
     */
    public function retrieve(EFaktureApi $api, DocumentDirection $direction, array $invoiceIds, float $throttleSeconds = self::DEFAULT_THROTTLE_SECONDS, int $maxRetryAttempts = self::DEFAULT_MAX_RETRY_ATTEMPTS): array
    {
        $route = DocumentDirection::OUTBOUND === $direction ? EFakturaAPIRoutes::SALES_INVOICE : EFakturaAPIRoutes::PURCHASE_INVOICE;
        $dtoClass = DocumentDirection::OUTBOUND === $direction ? SimpleSalesInvoiceDto::class : SimplePurchaseInvoiceDto::class;

        $invoices = [];
        $isFirst = true;
        foreach ($invoiceIds as $invoiceId) {
            if (!$isFirst) {
                await(sleep($throttleSeconds));
            }
            $isFirst = false;

            /** @var array{InvoiceId: int|string, GlobUniqId: string|null, Comment: string|null, CirStatus: string, CirInvoiceId: string|null, Version: int|string, LastModifiedUtc: string, CirSettledAmount: int|string, VatNumberFactoringCompany: string|null, FactoringContractNumber: string|null, CancelComment: string|null, StornoComment: string|null, Status: string} $response */
            $response = $this->getWithRetry($api, $route, $invoiceId, $maxRetryAttempts);

            $status = DocumentDirection::OUTBOUND === $direction
                ? SalesInvoiceStatus::from($response['Status'])
                : PurchaseInvoiceStatus::from($response['Status']);

            $invoices[$invoiceId] = new $dtoClass(
                $status,
                (int) $response['InvoiceId'],
                $response['GlobUniqId'],
                $response['Comment'],
                constant(sprintf('%s::%s', CirInvoiceStatus::class, $response['CirStatus'])),
                $response['CirInvoiceId'],
                (int) $response['Version'],
                new \DateTimeImmutable($response['LastModifiedUtc']),
                (int) $response['CirSettledAmount'],
                $response['VatNumberFactoringCompany'],
                $response['FactoringContractNumber'],
                $response['CancelComment'],
                $response['StornoComment'],
            );
        }

        return $invoices;
    }

    /**
     * Downloads the full original UBL XML document from SEF for the given ids.
     * Pass a single-element array to fetch just one invoice.
     *
     * @param int[] $invoiceIds
     *
     * @return array<int, string> invoiceId => raw UBL XML
     */
    public function retrieveXml(EFaktureApi $api, DocumentDirection $direction, array $invoiceIds, float $throttleSeconds = self::DEFAULT_THROTTLE_SECONDS, int $maxRetryAttempts = self::DEFAULT_MAX_RETRY_ATTEMPTS): array
    {
        $route = DocumentDirection::OUTBOUND === $direction ? EFakturaAPIRoutes::SALES_INVOICE_XML : EFakturaAPIRoutes::PURCHASE_INVOICE_XML;

        $documents = [];
        $isFirst = true;
        foreach ($invoiceIds as $invoiceId) {
            if (!$isFirst) {
                await(sleep($throttleSeconds));
            }
            $isFirst = false;

            $documents[$invoiceId] = $this->getRawWithRetry($api, $route, $invoiceId, $maxRetryAttempts);
        }

        return $documents;
    }

    /**
     * Downloads the full original UBL XML document for each id (see retrieveXml())
     * and converts it into a plain nested array, suitable for json_encode().
     *
     * This is a generic structural XML->array conversion, not a typed UBL parser:
     * i3or1s/UBL only builds/serializes XML from its own model classes, it has no
     * deserializer back into them. See Util\XmlToArrayConverter for details.
     *
     * @param int[] $invoiceIds
     *
     * @return array<int, array<string, mixed>>
     */
    public function retrieveDocuments(EFaktureApi $api, DocumentDirection $direction, array $invoiceIds, float $throttleSeconds = self::DEFAULT_THROTTLE_SECONDS, int $maxRetryAttempts = self::DEFAULT_MAX_RETRY_ATTEMPTS): array
    {
        $documents = [];
        foreach ($this->retrieveXml($api, $direction, $invoiceIds, $throttleSeconds, $maxRetryAttempts) as $invoiceId => $xml) {
            $documents[$invoiceId] = XmlToArrayConverter::toArray($xml);
        }

        return $documents;
    }

    /**
     * @return array<string, string|int|bool>
     */
    private function getWithRetry(EFaktureApi $api, EFakturaAPIRoutes $route, int $invoiceId, int $maxRetryAttempts): array
    {
        $attempt = 0;
        while (true) {
            try {
                return $api->getResource($route, ['invoiceId' => $invoiceId]);
            } catch (ResourceUnavailable $e) {
                if (429 !== $e->getCode() || $attempt >= $maxRetryAttempts) {
                    throw $e;
                }
                await(sleep(self::RETRY_BASE_DELAY_SECONDS * 2 ** $attempt));
                ++$attempt;
            }
        }
    }

    private function getRawWithRetry(EFaktureApi $api, EFakturaAPIRoutes $route, int $invoiceId, int $maxRetryAttempts): string
    {
        $attempt = 0;
        while (true) {
            try {
                return $api->getRawResource($route, ['invoiceId' => $invoiceId]);
            } catch (ResourceUnavailable $e) {
                if (429 !== $e->getCode() || $attempt >= $maxRetryAttempts) {
                    throw $e;
                }
                await(sleep(self::RETRY_BASE_DELAY_SECONDS * 2 ** $attempt));
                ++$attempt;
            }
        }
    }
}
