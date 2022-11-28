<?php

namespace Boris\EFakture\Model;

final class SalesInvoiceAttachmentDto
{
    public readonly ?int $invoiceId;
    public readonly ?string $fileName;
    public readonly ?string $fileData; // byte
    public readonly int $id;
    public readonly int $fileSize;
    public readonly \DateTimeImmutable $createdUtc;
    public readonly bool $isUbl;
    public readonly bool $isLink;
    public readonly ?string $link;

    public function __construct(?int $invoiceId, ?string $fileName, ?string $fileData, int $id, int $fileSize, \DateTimeImmutable $createdUtc, bool $isUbl, bool $isLink, ?string $link)
    {
        $this->invoiceId = $invoiceId;
        $this->fileName = $fileName;
        $this->fileData = $fileData;
        $this->id = $id;
        $this->fileSize = $fileSize;
        $this->createdUtc = $createdUtc;
        $this->isUbl = $isUbl;
        $this->isLink = $isLink;
        $this->link = $link;
    }
}
