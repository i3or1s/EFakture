<?php

namespace Boris\EFakture\Model;

final class CirTicketDto
{
    public readonly int $id;
    public readonly ?string $cirId;
    public readonly ?string $category;
    public readonly ?string $data;
    public readonly int $organizationId;
    public readonly ?string $userComment;
    public readonly ?string $operatorComment; // object
    public readonly CirTicketStatus $status;
    public readonly \DateTimeImmutable $creationDate;
    public readonly ?\DateTimeImmutable $closingDate;
    public readonly ?string $categoryCyr;
    public readonly ?string $companyNumber;
    public readonly ?string $organizationName;
    public readonly CirResourceType $resourceId;
    public readonly CirTicketHistoryDto $cirTicketHistory;

    public function __construct(int $id, ?string $cirId, ?string $category, ?string $data, int $organizationId, ?string $userComment, ?string $operatorComment, CirTicketStatus $status, \DateTimeImmutable $creationDate, ?\DateTimeImmutable $closingDate, ?string $categoryCyr, ?string $companyNumber, ?string $organizationName, CirResourceType $resourceId, CirTicketHistoryDto $cirTicketHistory)
    {
        $this->id = $id;
        $this->cirId = $cirId;
        $this->category = $category;
        $this->data = $data;
        $this->organizationId = $organizationId;
        $this->userComment = $userComment;
        $this->operatorComment = $operatorComment;
        $this->status = $status;
        $this->creationDate = $creationDate;
        $this->closingDate = $closingDate;
        $this->categoryCyr = $categoryCyr;
        $this->companyNumber = $companyNumber;
        $this->organizationName = $organizationName;
        $this->resourceId = $resourceId;
        $this->cirTicketHistory = $cirTicketHistory;
    }
}
