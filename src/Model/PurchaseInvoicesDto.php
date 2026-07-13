<?php

namespace i3or1s\EFakture\Model;

final class PurchaseInvoicesDto
{
    /** @var int[] */
    public readonly array $purchaseInvoiceIds;

    /**
     * @param int[] $purchaseInvoiceIds
     */
    public function __construct(array $purchaseInvoiceIds)
    {
        $this->purchaseInvoiceIds = $purchaseInvoiceIds;
    }
}
