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

    public function __construct(float $taxableAmount, int $tax, ?float $taxAmount = null, ?string $taxExemptionReasonCode = null)
    {
        if (0 === $tax && null === $taxExemptionReasonCode) {
            throw new \Exception('When tax is 0 then exemption reason must be provided');
        }
        $this->taxSubtotal = new \i3or1s\UBL\CAC\TaxSubtotal(
            new TaxCategory(
                new ID(
                    new NormalizedString(0 === $tax ? 'O' : 'S'),
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                null,
                new Percent(
                    new XsdDecimal($tax),
                    null
                ),
                null,
                null,
                0 === $tax ? new TaxExemptionReasonCode(
                    new NormalizedString($taxExemptionReasonCode),
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
                    new ID(
                        new \i3or1s\UBL\Basic\NormalizedString('VAT'),
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
                    null
                )
            ),
            new TaxAmount(
                new XsdDecimal($taxAmount ?? round($taxableAmount * ($tax / 100), 2)),
                new NormalizedString('RSD'),
                null
            ),
            new TaxableAmount(
                new XsdDecimal($taxableAmount),
                new NormalizedString('RSD'),
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
