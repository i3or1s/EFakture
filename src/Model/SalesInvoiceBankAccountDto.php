<?php

namespace Boris\EFakture\Model;

final class SalesInvoiceBankAccountDto
{
    public readonly int $bankAccountId;
    public readonly int $salesInvoiceId;
    public readonly ?string $unifiedBankAccount;

    public function __construct(int $bankAccountId, int $salesInvoiceId, ?string $unifiedBankAccount)
    {
        $this->bankAccountId = $bankAccountId;
        $this->salesInvoiceId = $salesInvoiceId;
        $this->unifiedBankAccount = $unifiedBankAccount;
    }
}
