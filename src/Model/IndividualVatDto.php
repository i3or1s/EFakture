<?php

namespace i3or1s\EFakture\Model;

final class IndividualVatDto
{
    public readonly int $individualVatId;
    public readonly int $companyId;
    public readonly ?string $documentNumber;
    public readonly VatRecordingStatus $vatRecordingStatus;
    public readonly ?\DateTimeImmutable $sendDate;
    public readonly ?\DateTimeImmutable $turnoverDate;
    public readonly ?\DateTimeImmutable $paymentDate;
    public readonly UBLInvoiceDocumentType $documentType;
    public readonly ?string $turnoverDescription;
    public readonly float $turnoverAmount;
    public readonly float $vatBaseAmount20;
    public readonly float $vatBaseAmount10;
    public readonly float $vatAmount;
    public readonly float $totalAmount;
    public readonly VatDeductionRight $vatDeductionRight;
    public readonly ?RelatedVatDocumentDto $relatedDocuments;
    public readonly DocumentDirection $documentDirection;
    public readonly ?string $relatedPartyIdentifier;
    public readonly bool $foreignDocument;

    public function __construct(int $individualVatId, int $companyId, ?string $documentNumber, VatRecordingStatus $vatRecordingStatus, ?\DateTimeImmutable $sendDate, ?\DateTimeImmutable $turnoverDate, ?\DateTimeImmutable $paymentDate, UBLInvoiceDocumentType $documentType, ?string $turnoverDescription, float $turnoverAmount, float $vatBaseAmount20, float $vatBaseAmount10, float $vatAmount, float $totalAmount, VatDeductionRight $vatDeductionRight, ?RelatedVatDocumentDto $relatedDocuments, DocumentDirection $documentDirection, ?string $relatedPartyIdentifier, bool $foreignDocument)
    {
        $this->individualVatId = $individualVatId;
        $this->companyId = $companyId;
        $this->documentNumber = $documentNumber;
        $this->vatRecordingStatus = $vatRecordingStatus;
        $this->sendDate = $sendDate;
        $this->turnoverDate = $turnoverDate;
        $this->paymentDate = $paymentDate;
        $this->documentType = $documentType;
        $this->turnoverDescription = $turnoverDescription;
        $this->turnoverAmount = $turnoverAmount;
        $this->vatBaseAmount20 = $vatBaseAmount20;
        $this->vatBaseAmount10 = $vatBaseAmount10;
        $this->vatAmount = $vatAmount;
        $this->totalAmount = $totalAmount;
        $this->vatDeductionRight = $vatDeductionRight;
        $this->relatedDocuments = $relatedDocuments;
        $this->documentDirection = $documentDirection;
        $this->relatedPartyIdentifier = $relatedPartyIdentifier;
        $this->foreignDocument = $foreignDocument;
    }
}
