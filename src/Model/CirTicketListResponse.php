<?php

namespace i3or1s\EFakture\Model;

final class CirTicketListResponse
{
    public readonly int $total;
    public readonly ?CirTicketDto $tickets;

    public function __construct(int $total, ?CirTicketDto $tickets)
    {
        $this->total = $total;
        $this->tickets = $tickets;
    }
}
