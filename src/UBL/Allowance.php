<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\EFakture\Util\Xml;
use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\Basic\XsdDecimal;
use i3or1s\UBL\CAC\AllowanceCharge;
use i3or1s\UBL\CAC\TaxCategory;
use i3or1s\UBL\CAC\TaxScheme;
use i3or1s\UBL\CBC\AllowanceChargeReason;
use i3or1s\UBL\CBC\Amount;
use i3or1s\UBL\CBC\BaseAmount;
use i3or1s\UBL\CBC\ChargeIndicator;
use i3or1s\UBL\CBC\ID;
use i3or1s\UBL\CBC\MultiplierFactorNumeric;
use i3or1s\UBL\CBC\Percent;

/**
 * A discount. On a line, pass it to InvoiceLine and leave the tax category out; on the
 * document, pass it to Invoice with the category and rate of the VAT group it reduces.
 */
final class Allowance
{
    public readonly AllowanceCharge $allowanceCharge;

    /**
     * @param float      $amount  the discount for the whole line (or document), not per unit
     * @param float|null $percent the discount percent applied to $baseAmount, when it is one
     */
    public function __construct(
        float $amount,
        ?float $baseAmount = null,
        ?float $percent = null,
        ?string $reason = null,
        string $currencyCode = 'RSD',
        ?string $taxCategory = null,
        int|float|null $taxPercent = null,
    ) {
        $this->allowanceCharge = new AllowanceCharge(
            null,
            new ChargeIndicator(false),
            null,
            null !== $reason ? [new AllowanceChargeReason(Xml::text($reason), null, null)] : null,
            null !== $percent ? new MultiplierFactorNumeric(new XsdDecimal($percent), null) : null,
            null,
            null,
            new Amount(new XsdDecimal(round($amount, 2)), new NormalizedString($currencyCode), null),
            null !== $baseAmount ? new BaseAmount(new XsdDecimal(round($baseAmount, 2)), new NormalizedString($currencyCode), null) : null,
            null,
            null,
            null,
            null !== $taxCategory ? [new TaxCategory(
                new ID(new NormalizedString($taxCategory), null, null, null, null, null, null, null),
                null,
                new Percent(new XsdDecimal($taxPercent ?? 0), null),
                null,
                null,
                null,
                null,
                null,
                null,
                new TaxScheme(new ID(new NormalizedString('VAT'), null, null, null, null, null, null, null), null, null, null, null)
            )] : null,
            null,
            null
        );
    }
}
