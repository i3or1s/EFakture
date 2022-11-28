<?php

namespace Boris\EFakture\Model;

final class PurchaseInvoicesDto
{
    public readonly ?int $purchaseInvoiceIds;

    public function __construct(?int $purchaseInvoiceIds)
    {
        $this->purchaseInvoiceIds = $purchaseInvoiceIds;
    }
}
