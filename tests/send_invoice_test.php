<?php

declare(strict_types=1);

require_once __DIR__.'/bootstrap.php';

use i3or1s\EFakture\Service\Invoice;
use i3or1s\EFakture\Service\UnitMeasures;
use i3or1s\EFakture\UBL\CAC\InvoicePeriod;
use i3or1s\EFakture\UBL\CBC\InvoiceTypeCode;
use i3or1s\EFakture\UBL\Invoice as UBLInvoice;
use i3or1s\EFakture\UBL\InvoiceDetails;
use i3or1s\EFakture\UBL\InvoiceLine;
use i3or1s\EFakture\UBL\Party;
use i3or1s\EFakture\UBL\PaymentMeans;
use i3or1s\EFakture\UBL\TaxSubtotal;
use i3or1s\EFakture\Util\EFaktureApi;
use React\Http\Browser;

$config = sefTestConfig();
assertConfigured($config, [
    'apiKey',
    'sellerPib', 'sellerName', 'sellerCity', 'sellerIdentification', 'sellerEmail', 'sellerBankAccount',
]);

// If no separate buyer is configured, send the test invoice to yourself
// (buyer == seller) so you don't need a second registered company to test with.
$config['buyerPib'] ??= $config['sellerPib'];
$config['buyerName'] ??= $config['sellerName'];
$config['buyerCity'] ??= $config['sellerCity'];
$config['buyerIdentification'] ??= $config['sellerIdentification'];
$config['buyerEmail'] ??= $config['sellerEmail'];

$api = new EFaktureApi(new Browser(), $config['apiKey'], $config['rootUri']);

$unitMeasures = (new UnitMeasures())->retrieve($api);

$netAmount = 1000.0;
$vatRate = 20;
$vatAmount = round($netAmount * ($vatRate / 100), 2);
$totalAmount = $netAmount + $vatAmount;

$issueDate = new DateTimeImmutable();

$invoice = new UBLInvoice(
    new InvoiceDetails(
        sprintf('TEST-%s', date('YmdHis')),
        $issueDate,
        $issueDate->modify('+7 days'),
        new InvoiceTypeCode(InvoiceTypeCode::COMMERCIAL_INVOICE),
        'RSD',
        new InvoicePeriod(InvoicePeriod::DELIVERY_ACTUAL_DATE),
        $config['contractNumber'],
        $issueDate
    ),
    new Party(
        $config['sellerPib'], null, $config['sellerName'], null, $config['sellerCity'],
        'RS', $config['sellerIdentification'], $config['sellerEmail'], true
    ),
    new Party(
        $config['buyerPib'], null, $config['buyerName'], $config['buyerAddress'], $config['buyerCity'],
        'RS', $config['buyerIdentification'], $config['buyerEmail'], true
    ),
    new PaymentMeans('30', null, $config['sellerBankAccount']),
    [
        new TaxSubtotal($netAmount, $vatRate),
    ],
    $netAmount, $netAmount, $totalAmount, 0, 0, $totalAmount,
    [
        new InvoiceLine(1, $unitMeasures['H87'], $netAmount, 'Test item', $vatRate, 1, null, null),
    ]
);

$selfTest = $config['buyerPib'] === $config['sellerPib'];
echo "Sending test invoice to SEF ({$config['rootUri']})".($selfTest ? ' [buyer == seller, self-test]' : '')."...\n";

$response = (new Invoice())->send($api, $invoice);

printf(
    "Invoice sent. InvoiceId=%d PurchaseInvoiceId=%d SalesInvoiceId=%d\n",
    $response->invoiceId,
    $response->purchaseInvoiceId,
    $response->salesInvoiceId
);
