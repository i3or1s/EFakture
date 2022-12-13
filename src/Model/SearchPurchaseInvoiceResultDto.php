<?php

namespace i3or1s\EFakture\Model;

final class SearchPurchaseInvoiceResultDto
{
    public readonly ?int $total;
    public readonly float $totalSum;
    public readonly ?SmallPurchaseInvoiceDto $invoices;
    public readonly ?string $requestId;

    public function __construct(?int $total, float $totalSum, ?SmallPurchaseInvoiceDto $invoices, ?string $requestId)
    {
        $this->total = $total;
        $this->totalSum = $totalSum;
        $this->invoices = $invoices;
        $this->requestId = $requestId;
    }
}
