<?php

namespace Boris\EFakture\Model;

final class SalesPrepaymentCalculationDto
{
    public readonly int $prepaymentCalculationId;
    public readonly float $prepaymentFeeReductionsWithoutVat;
    public readonly float $totalPrepaymentWithoutVat;
    public readonly float $prepaymentPaidVat;
    public readonly float $totalPrepaymentInvoice;
    public readonly ?SalesPrepaymentCalculationDtoVatPerRateParametersDto $prepaymentVatPerRateParameters;

    public function __construct(int $prepaymentCalculationId, float $prepaymentFeeReductionsWithoutVat, float $totalPrepaymentWithoutVat, float $prepaymentPaidVat, float $totalPrepaymentInvoice, ?SalesPrepaymentCalculationDtoVatPerRateParametersDto $prepaymentVatPerRateParameters)
    {
        $this->prepaymentCalculationId = $prepaymentCalculationId;
        $this->prepaymentFeeReductionsWithoutVat = $prepaymentFeeReductionsWithoutVat;
        $this->totalPrepaymentWithoutVat = $totalPrepaymentWithoutVat;
        $this->prepaymentPaidVat = $prepaymentPaidVat;
        $this->totalPrepaymentInvoice = $totalPrepaymentInvoice;
        $this->prepaymentVatPerRateParameters = $prepaymentVatPerRateParameters;
    }
}
