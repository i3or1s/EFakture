<?php

namespace i3or1s\EFakture\Service;

use i3or1s\EFakture\Model\MiniInvoiceDto;
use i3or1s\EFakture\Model\SendToCir;
use i3or1s\EFakture\UBL\Invoice as UBLInvoice;
use i3or1s\EFakture\Util\EFakturaAPIRoutes;
use i3or1s\EFakture\Util\EFaktureApi;

final class Invoice
{
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
}
