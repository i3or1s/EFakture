<?php

namespace Boris\EFakture\Model;

final class SspBankAccountDto
{
    public readonly ?int $bankAccountId;
    public readonly ?int $bankId;
    public readonly ?string $currency;
    public readonly ?string $iban;
    public readonly ?string $swift;
    public readonly bool $isPrimary;
    public readonly ?string $unifiedBankAccount;

    public function __construct(?int $bankAccountId, ?int $bankId, ?string $currency, ?string $iban, ?string $swift, bool $isPrimary, ?string $unifiedBankAccount)
    {
        $this->bankAccountId = $bankAccountId;
        $this->bankId = $bankId;
        $this->currency = $currency;
        $this->iban = $iban;
        $this->swift = $swift;
        $this->isPrimary = $isPrimary;
        $this->unifiedBankAccount = $unifiedBankAccount;
    }
}
