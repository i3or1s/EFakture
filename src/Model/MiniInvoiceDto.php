<?php

namespace Boris\EFakture\Model;

final class MiniInvoiceDto
{
    public readonly int $invoiceId;
    public readonly int $purchaseInvoiceId;
    public readonly int $salesInvoiceId;

    public function __construct(int $invoiceId, int $purchaseInvoiceId, int $salesInvoiceId)
    {
        $this->invoiceId = $invoiceId;
        $this->purchaseInvoiceId = $purchaseInvoiceId;
        $this->salesInvoiceId = $salesInvoiceId;
    }
}
