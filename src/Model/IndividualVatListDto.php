<?php

namespace Boris\EFakture\Model;

final class IndividualVatListDto
{
    public readonly int $individualVatId;
    public readonly ?string $documentNumber;
    public readonly VatRecordingStatus $vatRecordingStatus;
    public readonly ?\DateTimeImmutable $sendDate;
    public readonly UBLInvoiceDocumentType $documentType;
    public readonly float $turnoverAmount;
    public readonly float $vatAmount;
    public readonly VatDeductionRight $vatDeductionRight;
    public readonly DocumentDirection $documentDirection;
    public readonly ?string $relatedPartyIdentifier;
    public readonly bool $foreignDocument;

    public function __construct(int $individualVatId, ?string $documentNumber, VatRecordingStatus $vatRecordingStatus, ?\DateTimeImmutable $sendDate, UBLInvoiceDocumentType $documentType, float $turnoverAmount, float $vatAmount, VatDeductionRight $vatDeductionRight, DocumentDirection $documentDirection, ?string $relatedPartyIdentifier, bool $foreignDocument)
    {
        $this->individualVatId = $individualVatId;
        $this->documentNumber = $documentNumber;
        $this->vatRecordingStatus = $vatRecordingStatus;
        $this->sendDate = $sendDate;
        $this->documentType = $documentType;
        $this->turnoverAmount = $turnoverAmount;
        $this->vatAmount = $vatAmount;
        $this->vatDeductionRight = $vatDeductionRight;
        $this->documentDirection = $documentDirection;
        $this->relatedPartyIdentifier = $relatedPartyIdentifier;
        $this->foreignDocument = $foreignDocument;
    }
}
