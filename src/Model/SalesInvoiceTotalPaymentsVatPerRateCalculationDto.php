<?php

namespace Boris\EFakture\Model;

final class SalesInvoiceTotalPaymentsVatPerRateCalculationDto
{
    public readonly int $calculationId;
    public readonly float $vatRate;
    public readonly float $baseSumForPaymentVatRate;
    public readonly float $vatPaymentPerRate;

    public function __construct(int $calculationId, float $vatRate, float $baseSumForPaymentVatRate, float $vatPaymentPerRate)
    {
        $this->calculationId = $calculationId;
        $this->vatRate = $vatRate;
        $this->baseSumForPaymentVatRate = $baseSumForPaymentVatRate;
        $this->vatPaymentPerRate = $vatPaymentPerRate;
    }
}
