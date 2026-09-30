<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\Basic\XsdDecimal;
use i3or1s\UBL\CAC\TaxCategory;
use i3or1s\UBL\CAC\TaxScheme;
use i3or1s\UBL\CBC\ID;
use i3or1s\UBL\CBC\Percent;
use i3or1s\UBL\CBC\TaxableAmount;
use i3or1s\UBL\CBC\TaxAmount;
use i3or1s\UBL\CBC\TaxExemptionReasonCode;

final class TaxSubtotal
{
    public readonly \i3or1s\UBL\CAC\TaxSubtotal $taxSubtotal;

    /**
     * One row of the VAT breakdown: the taxable base and VAT of one (category, rate) pair.
     *
     * @param string|null $category VAT category (see TaxCategoryCode). When null it is derived
     *                              from the rate as before: S above 0 %, O at 0 %.
     * @param string|null $taxExemptionReasonCode required for every category other than S
     */
    public function __construct(
        float $taxableAmount,
        int|float $tax,
        ?float $taxAmount = null,
        ?string $taxExemptionReasonCode = null,
        ?string $category = null,
        string $currencyCode = 'RSD',
    ) {
        $category ??= 0.0 === (float) $tax ? TaxCategoryCode::OUT_OF_SCOPE : TaxCategoryCode::STANDARD;
        $needsReason = TaxCategoryCode::requiresExemptionReason($category);
        if ($needsReason && (null === $taxExemptionReasonCode || '' === $taxExemptionReasonCode)) {
            throw new \Exception(sprintf('VAT category %s needs an exemption reason code', $category));
        }
        $this->taxSubtotal = new \i3or1s\UBL\CAC\TaxSubtotal(
            new TaxCategory(
                new ID(new NormalizedString($category), null, null, null, null, null, null, null),
                null,
                new Percent(new XsdDecimal($tax), null),
                null,
                null,
                $needsReason ? new TaxExemptionReasonCode(
                    new NormalizedString((string) $taxExemptionReasonCode),
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ) : null,
                null,
                null,
                null,
                new TaxScheme(
                    new ID(new NormalizedString('VAT'), null, null, null, null, null, null, null),
                    null,
                    null,
                    null,
                    null
                )
            ),
            new TaxAmount(
                new XsdDecimal($taxAmount ?? round($taxableAmount * ($tax / 100), 2)),
                new NormalizedString($currencyCode),
                null
            ),
            new TaxableAmount(
                new XsdDecimal($taxableAmount),
                new NormalizedString($currencyCode),
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
