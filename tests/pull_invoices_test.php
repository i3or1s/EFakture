<?php

declare(strict_types=1);

require_once __DIR__.'/bootstrap.php';

use i3or1s\EFakture\Model\DocumentDirection;
use i3or1s\EFakture\Service\Invoice;
use i3or1s\EFakture\Util\EFaktureApi;
use React\Http\Browser;

$config = sefTestConfig();
assertConfigured($config, ['apiKey']);

$api = new EFaktureApi(new Browser(), $config['apiKey'], $config['rootUri']);
$invoiceService = new Invoice();

// SEF_PULL_DIRECTION=Outbound (invoices you sent, default) or Inbound (invoices you received).
$direction = DocumentDirection::from($config['pullDirection']);
$idsField = DocumentDirection::OUTBOUND === $direction ? 'salesInvoiceIds' : 'purchaseInvoiceIds';

$dateFrom = null !== $config['pullDateFrom'] ? new DateTimeImmutable($config['pullDateFrom']) : null;
$dateTo = null !== $config['pullDateTo'] ? new DateTimeImmutable($config['pullDateTo']) : null;

printf("Pulling %s invoice ids from SEF (%s)...\n", $direction->value, $config['rootUri']);

$ids = $invoiceService->pull($api, $direction, $config['pullStatus'], $dateFrom, $dateTo);

printf("Found %d invoice id(s) on SEF.\n", count($ids->$idsField));

$idsToFetch = array_slice($ids->$idsField, 0, max(0, (int) $config['pullLimit']));

if ([] === $idsToFetch) {
    echo "Nothing to retrieve (no ids found, or SEF_PULL_LIMIT is 0).\n";
    exit(0);
}

printf("Retrieving full details for %d invoice(s): %s\n", count($idsToFetch), implode(', ', $idsToFetch));

$invoices = $invoiceService->retrieve($api, $direction, $idsToFetch);

foreach ($invoices as $invoiceId => $invoice) {
    printf(
        "InvoiceId=%d Status=%s CirStatus=%s LastModifiedUtc=%s\n",
        $invoiceId,
        $invoice->status->value,
        $invoice->cirStatus->name,
        $invoice->lastModifiedUtc->format(DATE_ATOM)
    );
}

$firstId = $idsToFetch[0];
printf("\nDownloading full UBL document for InvoiceId=%d and converting it to JSON...\n", $firstId);

$documents = $invoiceService->retrieveDocuments($api, $direction, [$firstId]);

echo json_encode($documents[$firstId], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), "\n";
//"cbc:ID": "TEST-20260713122602",
//"cbc:ID": "TEST-20260713122644",