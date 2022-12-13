<?php

namespace i3or1s\EFakture\Model;

final class AcceptRejectPurchaseInvoice
{
    public readonly int $invoiceId;
    public readonly bool $accepted;
    public readonly ?string $comment;

    public function __construct(int $invoiceId, bool $accepted, ?string $comment)
    {
        $this->invoiceId = $invoiceId;
        $this->accepted = $accepted;
        $this->comment = $comment;
    }
}
