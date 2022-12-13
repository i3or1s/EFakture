<?php

namespace i3or1s\EFakture\Model;

final class SalesPrepaymentCalculationDtoVatPerRateParametersDto
{
    public readonly int $prepaymentCalculationVatPerRateParametersId;
    public readonly float $vatRate;
    public readonly float $prepaymentVatBaseReduction;
    public readonly float $prepaidVatPerRate;

    public function __construct(int $prepaymentCalculationVatPerRateParametersId, float $vatRate, float $prepaymentVatBaseReduction, float $prepaidVatPerRate)
    {
        $this->prepaymentCalculationVatPerRateParametersId = $prepaymentCalculationVatPerRateParametersId;
        $this->vatRate = $vatRate;
        $this->prepaymentVatBaseReduction = $prepaymentVatBaseReduction;
        $this->prepaidVatPerRate = $prepaidVatPerRate;
    }
}
