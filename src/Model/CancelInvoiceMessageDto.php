<?php

namespace Boris\EFakture\Model;

final class CancelInvoiceMessageDto
{
    public readonly int $invoiceId;
    public readonly string $cancelComments;

    public function __construct(int $invoiceId, string $cancelComments)
    {
        $this->invoiceId = $invoiceId;
        $this->cancelComments = $cancelComments;
    }
}
