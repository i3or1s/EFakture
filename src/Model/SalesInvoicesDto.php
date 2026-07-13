<?php

namespace i3or1s\EFakture\Model;

final class SalesInvoicesDto
{
    /** @var int[] */
    public readonly array $salesInvoiceIds;

    /**
     * @param int[] $salesInvoiceIds
     */
    public function __construct(array $salesInvoiceIds)
    {
        $this->salesInvoiceIds = $salesInvoiceIds;
    }
}
