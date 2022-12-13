<?php

namespace i3or1s\EFakture\UBL\CAC;

/**
 * https://www.efaktura.gov.rs/view_file.php?file_id=229&cache=sr
 * https://docs.peppol.eu/poacc/billing/3.0/codelist/UNCL2005/
 * Начин одређивања када настаје пореска обавеза, а може бити једна од три вредности:
 * 35 – према датуму промета (BT72);
 * 432 – према датуму плаћања (BT-9);
 * 3 – према датуму издавања фактуре (BT-2).
 */
final class InvoicePeriod
{
    const INVOICE_ISSUE_DATE = 3;
    const DELIVERY_ACTUAL_DATE = 35;
    const PAID_TO_DATE = 432;

    public readonly \i3or1s\UBL\CAC\InvoicePeriod $invoicePeriod;

    public function __construct(int $invoicePeriod)
    {
        if (!in_array($invoicePeriod, [self::INVOICE_ISSUE_DATE, self::DELIVERY_ACTUAL_DATE, self::PAID_TO_DATE])) {
            throw new \Exception('Invalid description code');
        }
        $this->invoicePeriod = new \i3or1s\UBL\CAC\InvoicePeriod(
            null,
            null,
            null,
            null,
            null,
            [new \i3or1s\UBL\CBC\DescriptionCode(
                new \i3or1s\UBL\Basic\NormalizedString((string) $invoicePeriod),
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            )],
            null
        );
    }
}
