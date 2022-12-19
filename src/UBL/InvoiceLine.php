<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\EFakture\Model\UnitMeasure;
use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\Basic\XsdDecimal;
use i3or1s\UBL\CAC\AllowanceCharge;
use i3or1s\UBL\CAC\ClassifiedTaxCategory;
use i3or1s\UBL\CAC\Item;
use i3or1s\UBL\CAC\Price;
use i3or1s\UBL\CAC\SellersItemIdentification;
use i3or1s\UBL\CAC\TaxScheme;
use i3or1s\UBL\CBC\ID;
use i3or1s\UBL\CBC\InvoicedQuantity;
use i3or1s\UBL\CBC\LineExtensionAmount;
use i3or1s\UBL\CBC\Name;
use i3or1s\UBL\CBC\Percent;
use i3or1s\UBL\CBC\PriceAmount;

final class InvoiceLine
{
    public readonly \i3or1s\UBL\CAC\InvoiceLine $invoiceLine;

    public function __construct(float $quantity, UnitMeasure $unitMeasure, float $amountPerItem, string $name, int $tax, int $orderNumber, ?AllowanceCharge $allowanceCharge)
    {
        $this->invoiceLine = new \i3or1s\UBL\CAC\InvoiceLine(
            new ID(
                new NormalizedString((string) $orderNumber),
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
            new InvoicedQuantity(
                new XsdDecimal($quantity),
                new NormalizedString($unitMeasure->code),
                null,
                null,
                null
            ),
            new LineExtensionAmount(
                new XsdDecimal(round($amountPerItem * $quantity, 2)),
                new NormalizedString('RSD'),
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
            [$allowanceCharge],
            null,
            null,
            new Item(
                null,
                null,
                null,
                null,
                new Name($name, null, null),
                null,
                null,
                null,
                null,
                null,
                null,
                new SellersItemIdentification(
                    new ID(
                        new NormalizedString((string) $orderNumber),
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
                [new ClassifiedTaxCategory(
                    new ID(
                        new NormalizedString($tax > 0 ? 'S' : 'O'),
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                    ),
                    null,
                    new Percent(new XsdDecimal($tax), null),
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    new TaxScheme(
                        new ID(
                            new NormalizedString('VAT'),
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
                )],
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ),
            new Price(
                new PriceAmount(
                    new XsdDecimal($amountPerItem),
                    new NormalizedString('RSD'),
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
                null
            ),
            null,
            null,
            null
        );
    }
}
