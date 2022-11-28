<?php

namespace Boris\EFakture\Model;

final class SmallInvoiceDto
{
    public readonly ?int $receiverId;
    public readonly bool $receiverIsDeleted;
    public readonly ?int $channel;
    public readonly ?string $channelAdress;
    public readonly ?string $serviceProvider;
    public readonly ErrorCodes $errorCode;
    public readonly SalesInvoiceStatus $status;
    public readonly CirInvoiceStatus $cirStatus;
    public readonly ?string $cirInvoiceId;
    public readonly InvoiceTypes $invoiceType;
    public readonly bool $ispAcceptedToRepresentCompany;
    public readonly ?string $ispName;
    public readonly ?string $serviceId;
    public readonly int $invoiceId;
    public readonly int $senderId;
    public readonly ?string $sender;
    public readonly ?string $receiver;
    public readonly ?string $invoiceNumber;
    public readonly ?\DateTimeImmutable $accountingDateUtc;
    public readonly ?\DateTimeImmutable $paymentDateUtc;
    public readonly ?\DateTimeImmutable $invoiceDateUtc;
    public readonly ?\DateTimeImmutable $invoiceSentDateUtc;
    public readonly ?string $referenceNumber;
    public readonly float $fineRatePerDay;
    public readonly ?string $description;
    public readonly ?string $note;
    public readonly ?string $orderNumber;
    public readonly ?string $currency;
    public readonly float $discountPercentage;
    public readonly float $discountAmount;
    public readonly float $sumWithoutVat;
    public readonly float $vatRate;
    public readonly float $vatSum;
    public readonly float $sumWithVat;
    public readonly \DateTimeImmutable $createdUtc;
    public readonly \DateTimeImmutable $lastModifiedUtc;
    public readonly int $version;
    public readonly ?string $modelNumber;

    public function __construct(?int $receiverId, bool $receiverIsDeleted, ?int $channel, ?string $channelAdress, ?string $serviceProvider, ErrorCodes $errorCode, SalesInvoiceStatus $status, CirInvoiceStatus $cirStatus, ?string $cirInvoiceId, InvoiceTypes $invoiceType, bool $ispAcceptedToRepresentCompany, ?string $ispName, ?string $serviceId, int $invoiceId, int $senderId, ?string $sender, ?string $receiver, ?string $invoiceNumber, ?\DateTimeImmutable $accountingDateUtc, ?\DateTimeImmutable $paymentDateUtc, ?\DateTimeImmutable $invoiceDateUtc, ?\DateTimeImmutable $invoiceSentDateUtc, ?string $referenceNumber, float $fineRatePerDay, ?string $description, ?string $note, ?string $orderNumber, ?string $currency, float $discountPercentage, float $discountAmount, float $sumWithoutVat, float $vatRate, float $vatSum, float $sumWithVat, \DateTimeImmutable $createdUtc, \DateTimeImmutable $lastModifiedUtc, int $version, ?string $modelNumber)
    {
        $this->receiverId = $receiverId;
        $this->receiverIsDeleted = $receiverIsDeleted;
        $this->channel = $channel;
        $this->channelAdress = $channelAdress;
        $this->serviceProvider = $serviceProvider;
        $this->errorCode = $errorCode;
        $this->status = $status;
        $this->cirStatus = $cirStatus;
        $this->cirInvoiceId = $cirInvoiceId;
        $this->invoiceType = $invoiceType;
        $this->ispAcceptedToRepresentCompany = $ispAcceptedToRepresentCompany;
        $this->ispName = $ispName;
        $this->serviceId = $serviceId;
        $this->invoiceId = $invoiceId;
        $this->senderId = $senderId;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->invoiceNumber = $invoiceNumber;
        $this->accountingDateUtc = $accountingDateUtc;
        $this->paymentDateUtc = $paymentDateUtc;
        $this->invoiceDateUtc = $invoiceDateUtc;
        $this->invoiceSentDateUtc = $invoiceSentDateUtc;
        $this->referenceNumber = $referenceNumber;
        $this->fineRatePerDay = $fineRatePerDay;
        $this->description = $description;
        $this->note = $note;
        $this->orderNumber = $orderNumber;
        $this->currency = $currency;
        $this->discountPercentage = $discountPercentage;
        $this->discountAmount = $discountAmount;
        $this->sumWithoutVat = $sumWithoutVat;
        $this->vatRate = $vatRate;
        $this->vatSum = $vatSum;
        $this->sumWithVat = $sumWithVat;
        $this->createdUtc = $createdUtc;
        $this->lastModifiedUtc = $lastModifiedUtc;
        $this->version = $version;
        $this->modelNumber = $modelNumber;
    }
}
