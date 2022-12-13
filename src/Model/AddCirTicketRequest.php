<?php

namespace i3or1s\EFakture\Model;

final class AddCirTicketRequest
{
    public readonly ?string $cirInvoiceId;
    public readonly ?string $data;
    public readonly ?float $amount;
    public readonly ?string $userComment;
    public readonly CirResourceType $resourceType;
    public readonly CirTicketCategory $cirTicketCategory;

    public function __construct(?string $cirInvoiceId, ?string $data, ?float $amount, ?string $userComment, CirResourceType $resourceType, CirTicketCategory $cirTicketCategory)
    {
        $this->cirInvoiceId = $cirInvoiceId;
        $this->data = $data;
        $this->amount = $amount;
        $this->userComment = $userComment;
        $this->resourceType = $resourceType;
        $this->cirTicketCategory = $cirTicketCategory;
    }
}
