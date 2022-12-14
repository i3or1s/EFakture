<?php

namespace i3or1s\EFakture\Model;

final class CirTicketHistoryDto
{
    public readonly int $cirTicketId;
    public readonly ?CirTicketChangeDto $cirTicketChanges;

    public function __construct(int $cirTicketId, ?CirTicketChangeDto $cirTicketChanges)
    {
        $this->cirTicketId = $cirTicketId;
        $this->cirTicketChanges = $cirTicketChanges;
    }
}
