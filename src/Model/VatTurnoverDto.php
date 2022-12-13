<?php

namespace i3or1s\EFakture\Model;

final class VatTurnoverDto
{
    public readonly int $vatTurnoverId;
    public readonly float $taxableAmount20;
    public readonly float $taxAmount20;
    public readonly float $totalAmount20;
    public readonly float $taxableAmount10;
    public readonly float $taxAmount10;
    public readonly float $totalAmount10;

    public function __construct(int $vatTurnoverId, float $taxableAmount20, float $taxAmount20, float $totalAmount20, float $taxableAmount10, float $taxAmount10, float $totalAmount10)
    {
        $this->vatTurnoverId = $vatTurnoverId;
        $this->taxableAmount20 = $taxableAmount20;
        $this->taxAmount20 = $taxAmount20;
        $this->totalAmount20 = $totalAmount20;
        $this->taxableAmount10 = $taxableAmount10;
        $this->taxAmount10 = $taxAmount10;
        $this->totalAmount10 = $totalAmount10;
    }
}
