<?php

namespace Boris\EFakture\Model;

final class RelatedVatDocumentDto
{
    public readonly int $relatedVatDocumentId;
    public readonly ?string $documentNumber;

    public function __construct(int $relatedVatDocumentId, ?string $documentNumber)
    {
        $this->relatedVatDocumentId = $relatedVatDocumentId;
        $this->documentNumber = $documentNumber;
    }
}
