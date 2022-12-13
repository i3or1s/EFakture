<?php

namespace i3or1s\EFakture\Model;

final class SalesInvoiceStatusChangeDto
{
    public readonly int $eventId;
    public readonly ?string $date;
    public readonly SalesInvoiceStatus $newInvoiceStatus;
    public readonly int $salesInvoiceId;
    public readonly ?string $comment;
    public readonly ?string $cirInvoiceId;
    public readonly ?string $subscriptionKey;
    public readonly ?string $stornoNumber;
    public readonly CirAssignmentChange $cirAssignmentChange;

    public function __construct(int $eventId, ?string $date, SalesInvoiceStatus $newInvoiceStatus, int $salesInvoiceId, ?string $comment, ?string $cirInvoiceId, ?string $subscriptionKey, ?string $stornoNumber, CirAssignmentChange $cirAssignmentChange)
    {
        $this->eventId = $eventId;
        $this->date = $date;
        $this->newInvoiceStatus = $newInvoiceStatus;
        $this->salesInvoiceId = $salesInvoiceId;
        $this->comment = $comment;
        $this->cirInvoiceId = $cirInvoiceId;
        $this->subscriptionKey = $subscriptionKey;
        $this->stornoNumber = $stornoNumber;
        $this->cirAssignmentChange = $cirAssignmentChange;
    }
}
