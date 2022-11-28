<?php

namespace Boris\EFakture\Model;

final class SelectedIndividualPrepaymentInvoiceDto
{
    public readonly int $selectedPrepaymentInvoiceId;
    public readonly int $prepaymentInvoiceId;
    public readonly ?string $prepaymentInvoiceNumber;
    public readonly float $prepayedAmount;
    public readonly float $prepayedVAT;
    public readonly ?string $currency;
    public readonly \DateTimeImmutable $paymentDate;
    public readonly int $contractId;
    public readonly ?\DateTimeImmutable $invoiceSentDateUtc;
    public readonly SalesIndividualPrepaymentCalculationDto $prepaymentCalculation;

    public function __construct(int $selectedPrepaymentInvoiceId, int $prepaymentInvoiceId, ?string $prepaymentInvoiceNumber, float $prepayedAmount, float $prepayedVAT, ?string $currency, \DateTimeImmutable $paymentDate, int $contractId, ?\DateTimeImmutable $invoiceSentDateUtc, SalesIndividualPrepaymentCalculationDto $prepaymentCalculation)
    {
        $this->selectedPrepaymentInvoiceId = $selectedPrepaymentInvoiceId;
        $this->prepaymentInvoiceId = $prepaymentInvoiceId;
        $this->prepaymentInvoiceNumber = $prepaymentInvoiceNumber;
        $this->prepayedAmount = $prepayedAmount;
        $this->prepayedVAT = $prepayedVAT;
        $this->currency = $currency;
        $this->paymentDate = $paymentDate;
        $this->contractId = $contractId;
        $this->invoiceSentDateUtc = $invoiceSentDateUtc;
        $this->prepaymentCalculation = $prepaymentCalculation;
    }
}
