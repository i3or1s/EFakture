<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\CAC\InvoiceDocumentReference;
use i3or1s\UBL\CBC\ID;
use i3or1s\UBL\CBC\IssueDate;

/**
 * The invoice a credit note (381) or debit note (383) corrects, or an advance invoice a final
 * invoice settles.
 */
final class BillingReference
{
    public readonly \i3or1s\UBL\CAC\BillingReference $billingReference;

    public function __construct(string $invoiceNumber, ?\DateTimeImmutable $issueDate)
    {
        $this->billingReference = new \i3or1s\UBL\CAC\BillingReference(
            new InvoiceDocumentReference(
                new ID(new NormalizedString($invoiceNumber), null, null, null, null, null, null, null),
                null,
                null,
                null !== $issueDate ? new IssueDate($issueDate->format('Y-m-d')) : null,
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
            ),
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
