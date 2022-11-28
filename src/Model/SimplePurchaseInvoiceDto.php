<?php

namespace Boris\EFakture\Model;

final class SimplePurchaseInvoiceDto
{
    public readonly PurchaseInvoiceStatus $status;
    public readonly int $invoiceId;
    public readonly ?string $globUniqId;
    public readonly ?string $comment;
    public readonly CirInvoiceStatus $cirStatus;
    public readonly ?string $cirInvoiceId;
    public readonly int $version;
    public readonly \DateTimeImmutable $lastModifiedUtc;
    public readonly int $cirSettledAmount;
    public readonly ?string $vatNumberFactoringCompany;
    public readonly ?string $factoringContractNumber;
    public readonly ?string $cancelComment;
    public readonly ?string $stornoComment;

    public function __construct(PurchaseInvoiceStatus $status, int $invoiceId, ?string $globUniqId, ?string $comment, CirInvoiceStatus $cirStatus, ?string $cirInvoiceId, int $version, \DateTimeImmutable $lastModifiedUtc, int $cirSettledAmount, ?string $vatNumberFactoringCompany, ?string $factoringContractNumber, ?string $cancelComment, ?string $stornoComment)
    {
        $this->status = $status;
        $this->invoiceId = $invoiceId;
        $this->globUniqId = $globUniqId;
        $this->comment = $comment;
        $this->cirStatus = $cirStatus;
        $this->cirInvoiceId = $cirInvoiceId;
        $this->version = $version;
        $this->lastModifiedUtc = $lastModifiedUtc;
        $this->cirSettledAmount = $cirSettledAmount;
        $this->vatNumberFactoringCompany = $vatNumberFactoringCompany;
        $this->factoringContractNumber = $factoringContractNumber;
        $this->cancelComment = $cancelComment;
        $this->stornoComment = $stornoComment;
    }
}
