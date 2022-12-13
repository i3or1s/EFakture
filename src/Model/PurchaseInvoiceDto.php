<?php

namespace i3or1s\EFakture\Model;

use i3or1s\EFakture\Util\IsStringLength;

final class PurchaseInvoiceDto
{
    public readonly int $invoiceId;
    public readonly int $senderApplicationId;
    public readonly int $senderId;
    public readonly int $receiverId;
    public readonly int $publicPurchaseContractSignerId;
    public readonly ?int $receiverUserAccountId;
    public readonly PurchaseInvoiceStatus $status;
    public readonly ?string $invoiceNumber;
    public readonly ?string $senderReceiverContractNumber;
    public readonly \DateTimeImmutable $accountingDateUtc;
    public readonly ?\DateTimeImmutable $invoiceDateUtc;
    public readonly \DateTimeImmutable $paymentDateUtc;
    public readonly ?string $referenceNumber;
    public readonly ?string $modelNumber;
    public readonly float $fineRatePerDay;
    public readonly ?string $description;
    public readonly ?string $note;
    public readonly ?string $orderNumber;
    public readonly ?string $currencyName;
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
    public readonly ?string $publicPurchaseContractSigner;
    public readonly int $duplicate;
    public readonly bool $isDeleted;
    public readonly ?PurchaseFileDto $files;
    public readonly ?PurchaseInvoiceCustomFieldDto $customFields;
    public readonly ?PurchaseSelectedPrepaymentInvoiceDto $purchaseSelectedPrepaymentInvoices;
    public readonly ?string $invoiceMessage; // min:0, max: 500
    public readonly ?string $acceptRejectMessage; // min:0, max: 500
    public readonly ?string $cirInvoiceId;
    public readonly ?string $cirAmountChangeId;
    public readonly CirInvoiceStatus $cirStatus;
    public readonly CirHistoryDto $cirHistory;
    public readonly InvoiceHistoryDto $cirAssignationHistory;
    public readonly float $cirSettledAmount;
    public readonly bool $isCreditInvoice;
    public readonly bool $isDebitNote;
    public readonly ?string $cancelInvoiceMessage;
    public readonly ?string $stornoNumber;
    public readonly bool $isPrepaymentInvoice;
    public readonly ?bool $addVatRate;
    public readonly ?float $receiverCalculatedVatRate;
    public readonly bool $vatNotCalculated;
    public readonly ?int $vatExemptionReasonId;
    public readonly ?string $vatExemptionReasonKey;
    public readonly ?string $vatExemtionFreeFormNote;
    public readonly float $totalToPay;
    public readonly VatPointDates $vatPointDate;
    public readonly ?string $vatNumberFactoringCompany;
    public readonly ?string $factoringContractNumber;
    public readonly SourceInvoiceSelectionMode $sourceInvoiceSelectionMode;
    public readonly \DateTimeImmutable $indebtednessPeriodFromDate;
    public readonly \DateTimeImmutable $indebtednessPeriodToDate;
    public readonly ?InvoiceLinkDto $sourceInvoices;
    public readonly ?InvoiceLinkDto $creditInvoices;
    public readonly ?InvoiceLinkDto $debitNotes;
    public readonly ?bool $ispAcceptedToRepresentCompany;
    public readonly ?string $ispName;

    public function __construct(int $invoiceId, int $senderApplicationId, int $senderId, int $receiverId, int $publicPurchaseContractSignerId, ?int $receiverUserAccountId, PurchaseInvoiceStatus $status, ?string $invoiceNumber, ?string $senderReceiverContractNumber, \DateTimeImmutable $accountingDateUtc, ?\DateTimeImmutable $invoiceDateUtc, \DateTimeImmutable $paymentDateUtc, ?string $referenceNumber, ?string $modelNumber, float $fineRatePerDay, ?string $description, ?string $note, ?string $orderNumber, ?string $currencyName, float $discountPercentage, float $discountAmount, float $sumWithoutVat, float $vatRate, float $vatSum, float $sumWithVat, ?string $serviceId, ?string $invoiceFilePath, ?string $sender, ?string $receiver, ?string $publicPurchaseContractSigner, int $duplicate, bool $isDeleted, ?PurchaseFileDto $files, ?PurchaseInvoiceCustomFieldDto $customFields, ?PurchaseSelectedPrepaymentInvoiceDto $purchaseSelectedPrepaymentInvoices, ?string $invoiceMessage, ?string $acceptRejectMessage, ?string $cirInvoiceId, ?string $cirAmountChangeId, CirInvoiceStatus $cirStatus, CirHistoryDto $cirHistory, InvoiceHistoryDto $cirAssignationHistory, float $cirSettledAmount, bool $isCreditInvoice, bool $isDebitNote, ?string $cancelInvoiceMessage, ?string $stornoNumber, bool $isPrepaymentInvoice, ?bool $addVatRate, ?float $receiverCalculatedVatRate, bool $vatNotCalculated, ?int $vatExemptionReasonId, ?string $vatExemptionReasonKey, ?string $vatExemtionFreeFormNote, float $totalToPay, VatPointDates $vatPointDate, ?string $vatNumberFactoringCompany, ?string $factoringContractNumber, SourceInvoiceSelectionMode $sourceInvoiceSelectionMode, \DateTimeImmutable $indebtednessPeriodFromDate, \DateTimeImmutable $indebtednessPeriodToDate, ?InvoiceLinkDto $sourceInvoices, ?InvoiceLinkDto $creditInvoices, ?InvoiceLinkDto $debitNotes, ?bool $ispAcceptedToRepresentCompany, ?string $ispName)
    {
        $this->invoiceId = $invoiceId;
        $this->senderApplicationId = $senderApplicationId;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->publicPurchaseContractSignerId = $publicPurchaseContractSignerId;
        $this->receiverUserAccountId = $receiverUserAccountId;
        $this->status = $status;
        $this->invoiceNumber = $invoiceNumber;
        $this->senderReceiverContractNumber = $senderReceiverContractNumber;
        $this->accountingDateUtc = $accountingDateUtc;
        $this->invoiceDateUtc = $invoiceDateUtc;
        $this->paymentDateUtc = $paymentDateUtc;
        $this->referenceNumber = $referenceNumber;
        $this->modelNumber = $modelNumber;
        $this->fineRatePerDay = $fineRatePerDay;
        $this->description = $description;
        $this->note = $note;
        $this->orderNumber = $orderNumber;
        $this->currencyName = $currencyName;
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
        $this->publicPurchaseContractSigner = $publicPurchaseContractSigner;
        $this->duplicate = $duplicate;
        $this->isDeleted = $isDeleted;
        $this->files = $files;
        $this->customFields = $customFields;
        $this->purchaseSelectedPrepaymentInvoices = $purchaseSelectedPrepaymentInvoices;

        if (!IsStringLength::validate($invoiceMessage, 0, 500)) {
            throw new \RuntimeException('invalid.length.invoice_message');
        }
        $this->invoiceMessage = $invoiceMessage;

        if (!IsStringLength::validate($acceptRejectMessage, 0, 500)) {
            throw new \RuntimeException('invalid.length.accept_reject_message');
        }
        $this->acceptRejectMessage = $acceptRejectMessage;

        $this->cirInvoiceId = $cirInvoiceId;
        $this->cirAmountChangeId = $cirAmountChangeId;
        $this->cirStatus = $cirStatus;
        $this->cirHistory = $cirHistory;
        $this->cirAssignationHistory = $cirAssignationHistory;
        $this->cirSettledAmount = $cirSettledAmount;
        $this->isCreditInvoice = $isCreditInvoice;
        $this->isDebitNote = $isDebitNote;
        $this->cancelInvoiceMessage = $cancelInvoiceMessage;
        $this->stornoNumber = $stornoNumber;
        $this->isPrepaymentInvoice = $isPrepaymentInvoice;
        $this->addVatRate = $addVatRate;
        $this->receiverCalculatedVatRate = $receiverCalculatedVatRate;
        $this->vatNotCalculated = $vatNotCalculated;
        $this->vatExemptionReasonId = $vatExemptionReasonId;
        $this->vatExemptionReasonKey = $vatExemptionReasonKey;
        $this->vatExemtionFreeFormNote = $vatExemtionFreeFormNote;
        $this->totalToPay = $totalToPay;
        $this->vatPointDate = $vatPointDate;
        $this->vatNumberFactoringCompany = $vatNumberFactoringCompany;
        $this->factoringContractNumber = $factoringContractNumber;
        $this->sourceInvoiceSelectionMode = $sourceInvoiceSelectionMode;
        $this->indebtednessPeriodFromDate = $indebtednessPeriodFromDate;
        $this->indebtednessPeriodToDate = $indebtednessPeriodToDate;
        $this->sourceInvoices = $sourceInvoices;
        $this->creditInvoices = $creditInvoices;
        $this->debitNotes = $debitNotes;
        $this->ispAcceptedToRepresentCompany = $ispAcceptedToRepresentCompany;
        $this->ispName = $ispName;
    }
}
