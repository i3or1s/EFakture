<?php

namespace i3or1s\EFakture\Model;

final class StornoInvoiceMessageDto
{
    public readonly int $invoiceId;
    public readonly ?string $stornoNumber;
    public readonly ?string $stornoComment;

    public function __construct(int $invoiceId, ?string $stornoNumber, ?string $stornoComment)
    {
        $this->invoiceId = $invoiceId;
        $this->stornoNumber = $stornoNumber;
        $this->stornoComment = $stornoComment;
    }
}
