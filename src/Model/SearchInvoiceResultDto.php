<?php

namespace i3or1s\EFakture\Model;

final class SearchInvoiceResultDto
{
    public readonly ?int $total;
    public readonly float $totalSum;
    public readonly ?SmallInvoiceDto $invoices;
    public readonly ?string $requestId;

    public function __construct(?int $total, float $totalSum, ?SmallInvoiceDto $invoices, ?string $requestId)
    {
        $this->total = $total;
        $this->totalSum = $totalSum;
        $this->invoices = $invoices;
        $this->requestId = $requestId;
    }
}
