<?php

namespace Boris\EFakture\Model;

final class SalesInvoicesDto
{
    public readonly ?int $salesInvoiceIds;

    public function __construct(?int $salesInvoiceIds)
    {
        $this->salesInvoiceIds = $salesInvoiceIds;
    }
}
