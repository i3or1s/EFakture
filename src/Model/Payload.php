<?php

namespace i3or1s\EFakture\Model;

final class Payload
{
    public readonly Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}
