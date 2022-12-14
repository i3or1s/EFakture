<?php

namespace i3or1s\EFakture\Model;

final class Invoice
{
    public readonly Header $header;
    public readonly Status $status;

    public function __construct(Header $header, Status $status)
    {
        $this->header = $header;
        $this->status = $status;
    }
}
