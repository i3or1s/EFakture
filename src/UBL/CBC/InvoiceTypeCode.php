<?php

namespace i3or1s\EFakture\UBL\CBC;

use i3or1s\UBL\Basic\NormalizedString;

final class InvoiceTypeCode
{
    const COMMERCIAL_INVOICE = 380;
    const BOOK_APPROVAL = 381;
    const BOOK_DEBT = 383;
    const CORRECTED_INVOICE = 384;
    const ADVANCE_INVOICE = 386;

    public readonly \i3or1s\UBL\CBC\InvoiceTypeCode $invoiceTypeCode;

    public function __construct(int $invoiceTypeCode)
    {
        if (!in_array(
            $invoiceTypeCode,
            [self::COMMERCIAL_INVOICE, self::BOOK_APPROVAL, self::BOOK_DEBT, self::CORRECTED_INVOICE, self::ADVANCE_INVOICE]
        )) {
            throw new \Exception('Invalid code type');
        }
        $this->invoiceTypeCode = new \i3or1s\UBL\CBC\InvoiceTypeCode(
            new NormalizedString((string) $invoiceTypeCode),
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
