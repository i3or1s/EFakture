<?php

namespace Boris\EFakture\Model;

use Boris\EFakture\Util\IsStringLength;

final class SmallPurchaseInvoiceDto
{
    public readonly int $invoiceId;
    public readonly int $senderApplicationId;
    public readonly int $senderId;
    public readonly int $receiverId;
    public readonly ?int $receiverUserAccountId;
    public readonly PurchaseInvoiceStatus $status;
    public readonly ?string $invoiceNumber;
    public readonly ?\DateTimeImmutable $accountingDateUtc;
    public readonly ?\DateTimeImmutable $invoiceDateUtc;
    public readonly \DateTimeImmutable $invoiceSentDateUtc;
    public readonly ?\DateTimeImmutable $paymentDateUtc;
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
    public readonly ?string $serviceId;
    public readonly ?string $invoiceFilePath;
    public readonly ?string $sender;
    public readonly ?string $receiver;
    public readonly int $duplicate;
    public readonly bool $isDeleted;
    public readonly ?PurchaseInvoiceCustomFieldDto $customFields;
    public readonly ?string $invoiceMessage; // min:0 max:500
    public readonly ?string $acceptRejectMessage; // min:0 max:500
    public readonly ?string $cirInvoiceId;
    public readonly CirInvoiceStatus $cirStatus;
    public readonly InvoiceTypes $invoiceType;
    public readonly bool $ispAcceptedToRepresentCompany;
    public readonly ?string $ispName;

    public function __construct(int $invoiceId, int $senderApplicationId, int $senderId, int $receiverId, ?int $receiverUserAccountId, PurchaseInvoiceStatus $status, ?string $invoiceNumber, ?\DateTimeImmutable $accountingDateUtc, ?\DateTimeImmutable $invoiceDateUtc, \DateTimeImmutable $invoiceSentDateUtc, ?\DateTimeImmutable $paymentDateUtc, ?string $referenceNumber, float $fineRatePerDay, ?string $description, ?string $note, ?string $orderNumber, ?string $currency, float $discountPercentage, float $discountAmount, float $sumWithoutVat, float $vatRate, float $vatSum, float $sumWithVat, ?string $serviceId, ?string $invoiceFilePath, ?string $sender, ?string $receiver, int $duplicate, bool $isDeleted, ?PurchaseInvoiceCustomFieldDto $customFields, ?string $invoiceMessage, ?string $acceptRejectMessage, ?string $cirInvoiceId, CirInvoiceStatus $cirStatus, InvoiceTypes $invoiceType, bool $ispAcceptedToRepresentCompany, ?string $ispName)
    {
        $this->invoiceId = $invoiceId;
        $this->senderApplicationId = $senderApplicationId;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->receiverUserAccountId = $receiverUserAccountId;
        $this->status = $status;
        $this->invoiceNumber = $invoiceNumber;
        $this->accountingDateUtc = $accountingDateUtc;
        $this->invoiceDateUtc = $invoiceDateUtc;
        $this->invoiceSentDateUtc = $invoiceSentDateUtc;
        $this->paymentDateUtc = $paymentDateUtc;
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
        $this->serviceId = $serviceId;
        $this->invoiceFilePath = $invoiceFilePath;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->duplicate = $duplicate;
        $this->isDeleted = $isDeleted;
        $this->customFields = $customFields;

        if (!IsStringLength::validate($invoiceMessage, 0, 500)) {
            throw new \RuntimeException('invalid.length.invoice_message');
        }
        $this->invoiceMessage = $invoiceMessage;

        if (!IsStringLength::validate($acceptRejectMessage, 0, 500)) {
            throw new \RuntimeException('invalid.length.accept_reject_message');
        }
        $this->acceptRejectMessage = $acceptRejectMessage;

        $this->cirInvoiceId = $cirInvoiceId;
        $this->cirStatus = $cirStatus;
        $this->invoiceType = $invoiceType;
        $this->ispAcceptedToRepresentCompany = $ispAcceptedToRepresentCompany;
        $this->ispName = $ispName;
    }
}
