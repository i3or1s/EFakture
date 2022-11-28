<?php

namespace Boris\EFakture\Model;

final class PurchaseInvoiceStatusChangeDto
{
    public readonly int $eventId;
    public readonly ?string $date;
    public readonly PurchaseInvoiceStatus $newInvoiceStatus;
    public readonly int $purchaseInvoiceId;
    public readonly ?string $comment;
    public readonly ?string $cirInvoiceId;
    public readonly ?string $subscriptionKey;
    public readonly ?string $stornoNumber;
    public readonly CirAssignmentChange $cirAssignmentChange;

    public function __construct(int $eventId, ?string $date, PurchaseInvoiceStatus $newInvoiceStatus, int $purchaseInvoiceId, ?string $comment, ?string $cirInvoiceId, ?string $subscriptionKey, ?string $stornoNumber, CirAssignmentChange $cirAssignmentChange)
    {
        $this->eventId = $eventId;
        $this->date = $date;
        $this->newInvoiceStatus = $newInvoiceStatus;
        $this->purchaseInvoiceId = $purchaseInvoiceId;
        $this->comment = $comment;
        $this->cirInvoiceId = $cirInvoiceId;
        $this->subscriptionKey = $subscriptionKey;
        $this->stornoNumber = $stornoNumber;
        $this->cirAssignmentChange = $cirAssignmentChange;
    }
}
