<?php

namespace i3or1s\EFakture\Model;

final class SalesInvoiceTotalPaymentsCalculationDto
{
    public readonly int $totalPaymentsCalculationId;
    public readonly float $paymentFeeWithoutVat;
    public readonly float $totalPayments;
    public readonly ?SalesInvoiceTotalPaymentsVatPerRateCalculationDto $vatPerRateCalculations;

    public function __construct(int $totalPaymentsCalculationId, float $paymentFeeWithoutVat, float $totalPayments, ?SalesInvoiceTotalPaymentsVatPerRateCalculationDto $vatPerRateCalculations)
    {
        $this->totalPaymentsCalculationId = $totalPaymentsCalculationId;
        $this->paymentFeeWithoutVat = $paymentFeeWithoutVat;
        $this->totalPayments = $totalPayments;
        $this->vatPerRateCalculations = $vatPerRateCalculations;
    }
}
