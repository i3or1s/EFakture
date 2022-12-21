<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\UBL\CAC\AccountingCustomerParty;
use i3or1s\UBL\CAC\AccountingSupplierParty;
use i3or1s\UBL\CAC\AdditionalDocumentReference;
use i3or1s\UBL\CAC\AllowanceCharge;
use i3or1s\UBL\CAC\LegalMonetaryTotal;
use i3or1s\UBL\CBC\Note;

final class Invoice
{
    public readonly \i3or1s\UBL\Invoice $invoice;

    /**
     * @param TaxSubtotal[] $taxSubtotal
     * @param InvoiceLine[] $invoiceItem
     * @param AllowanceCharge[]|null $allowanceCharge
     * @param Note[]|null $note
     * @param AdditionalDocumentReference[]|null $additionalDocumentReference
     */
    public function __construct(
        InvoiceDetails $invoiceDetails,
        Party $issuerParty,
        Party $customerParty,
        PaymentMeans $paymentMeans,
        array $taxSubtotal,
        float $sumOfInvoiceLineNetAmount,
        float $invoiceTotalAmountWithoutVAT,
        float $invoiceTotalAmountWithVAT,
        ?float $sumOfAllowanceOnDocument,
        ?float $paidAmount,
        float $amountDueForPayment,
        array $invoiceItem,
        ?array $allowanceCharge = null,
        ?array $note = null,
        ?array $additionalDocumentReference = null

    ) {
        /** @var \i3or1s\UBL\CAC\InvoiceLine[] $invoiceLine */
        $invoiceLine = [];
        foreach ($invoiceItem as $item) {
            $invoiceLine[] = $item->invoiceLine;
        }
        /** @var \i3or1s\UBL\CAC\TaxSubtotal[] $taxSubtotalParsed */
        $taxSubtotalParsed = [];
        $taxTotalAmount = 0;
        foreach ($taxSubtotal as $item) {
            $taxSubtotalParsed[] = $item->taxSubtotal;
            $taxTotalAmount += $item->taxSubtotal->TaxAmount->value->value;
        }

        $this->invoice = new \i3or1s\UBL\Invoice(
            null,
            null,
            $invoiceDetails->customizationId,
            null,
            null,
            $invoiceDetails->invoiceId,
            null,
            null,
            $invoiceDetails->issueDate,
            null,
            $invoiceDetails->dueDate,
            $invoiceDetails->invoiceTypeCode->invoiceTypeCode,
            $note,
            null,
            $invoiceDetails->documentCurrency,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            [$invoiceDetails->invoicePeriod],
            null,
            null,
            null,
            null,
            null,
            null,
            [$invoiceDetails->contractNumber],
            $additionalDocumentReference,
            null,
            null,
            new AccountingSupplierParty(
                null,
                null,
                null,
                $issuerParty->party,
                null,
                null,
                null
            ),
            new AccountingCustomerParty(
                null,
                null,
                null,
                $customerParty->party,
                null,
                null,
                null
            ),
            null,
            null,
            null,
            null,
            $invoiceDetails->deliveryDate === null ? null : [$invoiceDetails->deliveryDate],
            null,
            [$paymentMeans->paymentMeans],
            null,
            null,
            $allowanceCharge,
            null,
            null,
            null,
            null,
            [new \i3or1s\UBL\CAC\TaxTotal(
                new \i3or1s\UBL\CBC\TaxAmount(
                    new \i3or1s\UBL\Basic\XsdDecimal(round($taxTotalAmount, 2)),
                    new \i3or1s\UBL\Basic\NormalizedString('RSD'),
                    null
                ),
                null,
                null,
                null,
                $taxSubtotalParsed
            )],
            null,
            new LegalMonetaryTotal(
                new \i3or1s\UBL\CBC\LineExtensionAmount(
                    new \i3or1s\UBL\Basic\XsdDecimal(round($sumOfInvoiceLineNetAmount, 2)),
                    new \i3or1s\UBL\Basic\NormalizedString('RSD'),
                    null
                ),
                new \i3or1s\UBL\CBC\TaxExclusiveAmount(
                    new \i3or1s\UBL\Basic\XsdDecimal(round($invoiceTotalAmountWithoutVAT, 2)),
                    new \i3or1s\UBL\Basic\NormalizedString('RSD'),
                    null
                ),
                new \i3or1s\UBL\CBC\TaxInclusiveAmount(
                    new \i3or1s\UBL\Basic\XsdDecimal(round($invoiceTotalAmountWithVAT, 2)),
                    new \i3or1s\UBL\Basic\NormalizedString('RSD'),
                    null
                ),
                null !== $sumOfAllowanceOnDocument ? new \i3or1s\UBL\CBC\AllowanceTotalAmount(
                    new \i3or1s\UBL\Basic\XsdDecimal(round($sumOfAllowanceOnDocument, 2)),
                    new \i3or1s\UBL\Basic\NormalizedString('RSD'),
                    null
                ) : null,
                null,
                null !== $paidAmount ? new \i3or1s\UBL\CBC\PrepaidAmount(
                    new \i3or1s\UBL\Basic\XsdDecimal(round($paidAmount, 2)),
                    new \i3or1s\UBL\Basic\NormalizedString('RSD'),
                    null
                ) : null,
                null,
                new \i3or1s\UBL\CBC\PayableAmount(
                    new \i3or1s\UBL\Basic\XsdDecimal(round($amountDueForPayment, 2)),
                    new \i3or1s\UBL\Basic\NormalizedString('RSD'),
                    null
                ),
                null
            ),
            $invoiceLine
        );
    }
}
