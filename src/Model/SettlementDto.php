<?php

namespace i3or1s\EFakture\Model;

final class SettlementDto
{
    public readonly ?\DateTimeImmutable $settlementDate;
    public readonly float $amount;
    public readonly ?string $comment;

    public function __construct(?\DateTimeImmutable $settlementDate, float $amount, ?string $comment)
    {
        $this->settlementDate = $settlementDate;
        $this->amount = $amount;
        $this->comment = $comment;
    }
}
