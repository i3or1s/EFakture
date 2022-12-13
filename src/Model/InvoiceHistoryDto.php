<?php

namespace i3or1s\EFakture\Model;

final class InvoiceHistoryDto
{
    public readonly int $invoiceId;
    public readonly ?InvoiceChangeDto $invoiceChanges;

    public function __construct(int $invoiceId, ?InvoiceChangeDto $invoiceChanges)
    {
        $this->invoiceId = $invoiceId;
        $this->invoiceChanges = $invoiceChanges;
    }
}
