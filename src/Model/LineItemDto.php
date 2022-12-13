<?php

namespace i3or1s\EFakture\Model;

use http\Exception\RuntimeException;
use i3or1s\EFakture\Util\IsNumberInRange;
use i3or1s\EFakture\Util\IsStringLength;

final class LineItemDto
{
    public readonly int $rowId;
    public readonly int $invoiceId;
    public readonly int $orderNo;
    public readonly ?string $code; // min:0, max:20
    public readonly ?string $description; // min:0, max:100
    public readonly ?string $unit; // min:0, max:20
    public readonly ?float $unitPrice;
    public readonly ?float $quantity;
    public readonly float $discountPercentage; // min:0, max: 100
    public readonly float $discountAmount;
    public readonly float $sumWithoutVat;
    public readonly ?float $vatRate; // min:0, max:100
    public readonly ?float $vatSum;
    public readonly ?float $sumWithVat;
    public readonly bool $vatNotCalculated;
    public readonly ?string $vatCategoryCode;

    public function __construct(int $rowId, int $invoiceId, int $orderNo, ?string $code, ?string $description, ?string $unit, ?float $unitPrice, ?float $quantity, float $discountPercentage, float $discountAmount, float $sumWithoutVat, ?float $vatRate, ?float $vatSum, ?float $sumWithVat, bool $vatNotCalculated, ?string $vatCategoryCode)
    {
        $this->rowId = $rowId;
        $this->invoiceId = $invoiceId;
        $this->orderNo = $orderNo;

        if (IsStringLength::validate($code, 0, 20)) {
            throw new RuntimeException('invalid.length.code');
        }
        $this->code = $code;

        if (IsStringLength::validate($description, 0, 100)) {
            throw new RuntimeException('invalid.length.email');
        }
        $this->description = $description;

        if (IsStringLength::validate($unit, 0, 20)) {
            throw new RuntimeException('invalid.length.email');
        }
        $this->unit = $unit;

        $this->unitPrice = $unitPrice;
        $this->quantity = $quantity;

        if (IsNumberInRange::range($discountPercentage, 0, 100)) {
            throw new RuntimeException('invalid.length.discount_percentage');
        }
        $this->discountPercentage = $discountPercentage;

        $this->discountAmount = $discountAmount;
        $this->sumWithoutVat = $sumWithoutVat;

        if (IsNumberInRange::range($vatRate, 0, 100)) {
            throw new RuntimeException('invalid.length.vat_rate');
        }
        $this->vatRate = $vatRate;

        $this->vatSum = $vatSum;
        $this->sumWithVat = $sumWithVat;
        $this->vatNotCalculated = $vatNotCalculated;
        $this->vatCategoryCode = $vatCategoryCode;
    }
}
