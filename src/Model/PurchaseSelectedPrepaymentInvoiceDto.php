<?php

namespace Boris\EFakture\Model;

final class PurchaseSelectedPrepaymentInvoiceDto
{
    public readonly int $invoiceId;
    public readonly ?string $invoiceNumber;
    public readonly float $prepayedAmount;
    public readonly float $prepayedVAT;
    public readonly ?string $currency;
    public readonly \DateTimeImmutable $paymentDate;
    public readonly int $contractId;

    public function __construct(int $invoiceId, ?string $invoiceNumber, float $prepayedAmount, float $prepayedVAT, ?string $currency, \DateTimeImmutable $paymentDate, int $contractId)
    {
        $this->invoiceId = $invoiceId;
        $this->invoiceNumber = $invoiceNumber;
        $this->prepayedAmount = $prepayedAmount;
        $this->prepayedVAT = $prepayedVAT;
        $this->currency = $currency;
        $this->paymentDate = $paymentDate;
        $this->contractId = $contractId;
    }
}
