<?php

namespace i3or1s\EFakture\Model;

final class SalesIndividualPrepaymentCalculationDto
{
    public readonly int $prepaymentCalculationId;
    public readonly float $prepaymentFeeReductionsWithoutVat;
    public readonly float $totalPrepaymentWithoutVat;
    public readonly float $prepaymentPaidVat;
    public readonly float $totalPrepaymentInvoice;
    public readonly ?SalesIndividualPrepaymentCalculationVatPerRateParametersDto $prepaymentVatPerRateParameters;

    public function __construct(int $prepaymentCalculationId, float $prepaymentFeeReductionsWithoutVat, float $totalPrepaymentWithoutVat, float $prepaymentPaidVat, float $totalPrepaymentInvoice, ?SalesIndividualPrepaymentCalculationVatPerRateParametersDto $prepaymentVatPerRateParameters)
    {
        $this->prepaymentCalculationId = $prepaymentCalculationId;
        $this->prepaymentFeeReductionsWithoutVat = $prepaymentFeeReductionsWithoutVat;
        $this->totalPrepaymentWithoutVat = $totalPrepaymentWithoutVat;
        $this->prepaymentPaidVat = $prepaymentPaidVat;
        $this->totalPrepaymentInvoice = $totalPrepaymentInvoice;
        $this->prepaymentVatPerRateParameters = $prepaymentVatPerRateParameters;
    }
}
