<?php

namespace Boris\EFakture\Model;

final class Payload
{
    public readonly Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}
