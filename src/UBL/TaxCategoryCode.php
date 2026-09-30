<?php

namespace i3or1s\EFakture\UBL;

/**
 * VAT category codes SEF accepts (UNCL5305 plus the Serbian ones). Every category other than
 * S needs an exemption reason code from SEF's getValueAddedTaxExemptionReasonList.
 */
final class TaxCategoryCode
{
    const STANDARD = 'S';
    const ZERO_RATED = 'Z';
    const EXEMPT = 'E';
    const REVERSE_CHARGE = 'AE';
    const OUT_OF_SCOPE = 'O';
    const NOT_VAT_PAYER = 'OE';
    const SPECIAL_PROCEDURE = 'SS';
    const NOT_SUBJECT = 'N';
    const ANTICIPATED = 'R';

    public static function requiresExemptionReason(string $category): bool
    {
        return self::STANDARD !== $category;
    }
}
