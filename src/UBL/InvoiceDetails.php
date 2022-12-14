<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\EFakture\UBL\CAC\InvoicePeriod;
use i3or1s\EFakture\UBL\CBC\InvoiceTypeCode;
use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\CAC\ContractDocumentReference;
use i3or1s\UBL\CAC\Delivery;
use i3or1s\UBL\CBC\ActualDeliveryDate;
use i3or1s\UBL\CBC\CustomizationID;
use i3or1s\UBL\CBC\DocumentCurrencyCode;
use i3or1s\UBL\CBC\DueDate;
use i3or1s\UBL\CBC\ID;
use i3or1s\UBL\CBC\IssueDate;

final class InvoiceDetails
{
    public readonly CustomizationID $customizationId;
    public readonly ID $invoiceId;
    public readonly IssueDate $issueDate;
    public readonly ?DueDate $dueDate;
    public readonly InvoiceTypeCode $invoiceTypeCode;
    public readonly DocumentCurrencyCode $documentCurrency;
    public readonly \i3or1s\UBL\CAC\InvoicePeriod $invoicePeriod;
    public readonly ContractDocumentReference $contractNumber;
    public readonly ?Delivery $deliveryDate;

    public function __construct(
        string $invoiceNumber,
        \DateTimeImmutable $issueDate,
        ?\DateTimeImmutable $dueDate,
        InvoiceTypeCode $invoiceTypeCode,
        string $currencyCode,
        InvoicePeriod $invoicePeriod,
        string $contractNumber,
        ?\DateTimeImmutable $deliveryDate
    ) {
        $this->customizationId = new CustomizationID(
            new NormalizedString('urn:cen.eu:en16931:2017#compliant#urn:mfin.gov.rs:srbdt:2021'),
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
        $this->invoiceId = new ID(
            new NormalizedString($invoiceNumber),
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
        $this->issueDate = new IssueDate($issueDate->format('Y-m-d'));
        $this->dueDate = $dueDate === null ? null : new DueDate($dueDate->format('Y-m-d'));
        $this->invoiceTypeCode = $invoiceTypeCode;
        $this->documentCurrency = new DocumentCurrencyCode(
            new NormalizedString($currencyCode),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
        $this->invoicePeriod = $invoicePeriod->invoicePeriod;

        $this->contractNumber = new ContractDocumentReference(
            new ID(
                new NormalizedString($contractNumber),
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $this->deliveryDate = $deliveryDate === null ? null : new Delivery(
            null,
            null,
            null,
            null,
            new ActualDeliveryDate($deliveryDate->format('Y-m-d')),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    }
}
