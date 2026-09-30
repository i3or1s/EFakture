<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\EFakture\Model\UnitMeasure;
use i3or1s\EFakture\Util\Xml;
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
use i3or1s\UBL\CBC\Note;
use i3or1s\UBL\CBC\Percent;
use i3or1s\UBL\CBC\PriceAmount;

final class InvoiceLine
{
    public readonly \i3or1s\UBL\CAC\InvoiceLine $invoiceLine;

    /**
     * @param float $quantity
     * @param UnitMeasure $unitMeasure
     * @param float $amountPerItem
     * @param string $name
     * @param int $tax
     * @param int $orderNumber
     * @param AllowanceCharge|null $allowanceCharge the line's discount (see Allowance): its amount is the
     *                                     total for the line, not per unit
     * @param Note[]|null $note
     * @param string|null $taxCategory VAT category (see TaxCategoryCode); derived from the rate when null
     * @param string|null $sellersItemId the seller's item code; the line number when null
     */
    public function __construct(
        float $quantity,
        UnitMeasure $unitMeasure,
        float $amountPerItem,
        string $name,
        int|float $tax,
        int $orderNumber,
        ?AllowanceCharge $allowanceCharge,
        ?array $note,
        ?string $taxCategory = null,
        string $currencyCode = 'RSD',
        ?string $sellersItemId = null,
    ) {
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
            $note,
            new InvoicedQuantity(
                new XsdDecimal($quantity),
                new NormalizedString($unitMeasure->code),
                null,
                null,
                null
            ),
            new LineExtensionAmount(
                new XsdDecimal(round($amountPerItem * $quantity - ($allowanceCharge?->Amount->value->value ?? 0), 2)),
                new NormalizedString($currencyCode),
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
            null === $allowanceCharge ? null : [$allowanceCharge],
            null,
            null,
            new Item(
                null,
                null,
                null,
                null,
                new Name(Xml::text($name), null, null),
                null,
                null,
                null,
                null,
                null,
                null,
                new SellersItemIdentification(
                    new ID(
                        new NormalizedString($sellersItemId ?? (string) $orderNumber),
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
                        new NormalizedString($taxCategory ?? ($tax > 0 ? TaxCategoryCode::STANDARD : TaxCategoryCode::OUT_OF_SCOPE)),
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
                    new NormalizedString($currencyCode),
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
