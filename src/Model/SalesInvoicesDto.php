<?php

namespace i3or1s\EFakture\Model;

final class SalesInvoicesDto
{
    public readonly ?int $salesInvoiceIds;

    public function __construct(?int $salesInvoiceIds)
    {
        $this->salesInvoiceIds = $salesInvoiceIds;
    }
}
