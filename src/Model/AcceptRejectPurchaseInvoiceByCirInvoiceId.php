<?php

namespace i3or1s\EFakture\Model;

final class AcceptRejectPurchaseInvoiceByCirInvoiceId
{
    public readonly ?string $cirInvoiceId;
    public readonly bool $accepted;
    public readonly ?string $comment;

    public function __construct(?string $cirInvoiceId, bool $accepted, ?string $comment)
    {
        $this->cirInvoiceId = $cirInvoiceId;
        $this->accepted = $accepted;
        $this->comment = $comment;
    }
}
