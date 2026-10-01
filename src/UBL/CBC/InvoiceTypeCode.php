<?php

namespace i3or1s\EFakture\UBL\CBC;

use i3or1s\UBL\Basic\NormalizedString;

final class InvoiceTypeCode
{
    const COMMERCIAL_INVOICE = 380;
    const CREDIT_NOTE = 381;
    const DEBIT_NOTE = 383;
    /** @deprecated use CREDIT_NOTE: 381 is a credit note (knjižno odobrenje) */
    const BOOK_APPROVAL = self::CREDIT_NOTE;
    /** @deprecated use DEBIT_NOTE: 383 is a debit note (knjižno zaduženje) */
    const BOOK_DEBT = self::DEBIT_NOTE;
    const CORRECTED_INVOICE = 384;
    const ADVANCE_INVOICE = 386;

    public readonly \i3or1s\UBL\CBC\InvoiceTypeCode $invoiceTypeCode;

    public function __construct(int $invoiceTypeCode)
    {
        if (!in_array(
            $invoiceTypeCode,
            [self::COMMERCIAL_INVOICE, self::CREDIT_NOTE, self::DEBIT_NOTE, self::CORRECTED_INVOICE, self::ADVANCE_INVOICE]
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
