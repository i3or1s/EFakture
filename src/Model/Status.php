<?php

namespace Boris\EFakture\Model;

final class Status
{
    public readonly ?string $previousInvoiceStatus;
    public readonly ?string $newInvoiceStatus;
    public readonly ?string $comment;

    public function __construct(?string $previousInvoiceStatus, ?string $newInvoiceStatus, ?string $comment)
    {
        $this->previousInvoiceStatus = $previousInvoiceStatus;
        $this->newInvoiceStatus = $newInvoiceStatus;
        $this->comment = $comment;
    }
}
