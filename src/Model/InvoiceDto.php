<?php

namespace i3or1s\EFakture\Model;

use i3or1s\EFakture\Util\IsStringLength;

final class InvoiceDto
{
    public readonly ?int $receiverId;
    public readonly SspCustomerSupplierDto $publicPurchaseContractSigner;
    public readonly ?int $publicPurchaseContractSignerContractId;
    public readonly SspContractDto $contract;
    public readonly SalesInvoiceStatus $status;
    public readonly CompanyDto $uasSender;
    public readonly int $totalRowsCount;
    public readonly ?int $channel;
    public readonly ?string $channelAddress;
    public readonly ?string $serviceProvider;
    public readonly ?LineItemDto $rows;
    public readonly ?string $invoiceMessage; // min:0, max:500
    public readonly ?string $acceptRejectMessage; // min:0, max:500
    public readonly ?SalesInvoiceAttachmentDto $attachments;
    public readonly ?SalesInvoiceBankAccountDto $bankAccounts;
    public readonly ?SelectedIndividualPrepaymentInvoiceDto $selectedPrepaymentInvoices;
    public readonly bool $isCreditInvoice;
    public readonly ?string $senderReceiverContractNumber;
    public readonly ErrorCodes $errorCode;
    public readonly ?\DateTimeImmutable $balanceDateUtc;
    public readonly ?float $balanceBeginSum;
    public readonly ?float $balanceInboundSum;
    public readonly ?float $balanceOutboundSum;
    public readonly ?float $balanceEndSum;
    public readonly ?float $totalToPay;
    public readonly ?bool $sendInvoiceToCir;
    public readonly ?string $cirInvoiceId;
    public readonly ?string $cirAmountChangeId;
    public readonly float $cirSettledAmount;
    public readonly ?bool $isProFormaInvoice;
    public readonly CirHistoryDto $cirHistory;
    public readonly InvoiceHistoryDto $cirAssignationHistory;
    public readonly CirInvoiceStatus $cirStatus;
    public readonly bool $isDebitNote;
    public readonly ?string $stornoNumber;
    public readonly ?string $cancelInvoiceMessage;
    public readonly ?string $prepaymentInvoiceNumber;
    public readonly bool $isPrepaymentInvoice;
    public readonly bool $vatNotCalculated;
    public readonly ?int $vatExemptionReasonId;
    public readonly ?string $vatExemptionReasonKey;
    public readonly ?string $vatExemtionFreeFormNote;
    public readonly int $vatPointDate;
    public readonly ?string $vatCategoryCode;
    public readonly ?string $globUniqId;
    public readonly ?string $vatNumberFactoringCompany;
    public readonly ?string $factoringContractNumber;
    public readonly SourceInvoiceSelectionMode $sourceInvoiceSelectionMode;
    public readonly ?\DateTimeImmutable $indebtednessPeriodFromDate;
    public readonly ?\DateTimeImmutable $indebtednessPeriodToDate;
    public readonly ?InvoiceLinkDto $sourceInvoices;
    public readonly ?InvoiceLinkDto $creditInvoices;
    public readonly ?InvoiceLinkDto $debitNotes;
    public readonly SalesPrepaymentCalculationDto $prepaymentCalculation;
    public readonly SalesInvoiceTotalPaymentsCalculationDto $invoiceTotalPaymentsCalculation;
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

    public function __construct(?int $receiverId, SspCustomerSupplierDto $publicPurchaseContractSigner, ?int $publicPurchaseContractSignerContractId, SspContractDto $contract, SalesInvoiceStatus $status, CompanyDto $uasSender, int $totalRowsCount, ?int $channel, ?string $channelAddress, ?string $serviceProvider, ?LineItemDto $rows, ?string $invoiceMessage, ?string $acceptRejectMessage, ?SalesInvoiceAttachmentDto $attachments, ?SalesInvoiceBankAccountDto $bankAccounts, ?SelectedIndividualPrepaymentInvoiceDto $selectedPrepaymentInvoices, bool $isCreditInvoice, ?string $senderReceiverContractNumber, ErrorCodes $errorCode, ?\DateTimeImmutable $balanceDateUtc, ?float $balanceBeginSum, ?float $balanceInboundSum, ?float $balanceOutboundSum, ?float $balanceEndSum, ?float $totalToPay, ?bool $sendInvoiceToCir, ?string $cirInvoiceId, ?string $cirAmountChangeId, float $cirSettledAmount, ?bool $isProFormaInvoice, CirHistoryDto $cirHistory, InvoiceHistoryDto $cirAssignationHistory, CirInvoiceStatus $cirStatus, bool $isDebitNote, ?string $stornoNumber, ?string $cancelInvoiceMessage, ?string $prepaymentInvoiceNumber, bool $isPrepaymentInvoice, bool $vatNotCalculated, ?int $vatExemptionReasonId, ?string $vatExemptionReasonKey, ?string $vatExemtionFreeFormNote, int $vatPointDate, ?string $vatCategoryCode, ?string $globUniqId, ?string $vatNumberFactoringCompany, ?string $factoringContractNumber, SourceInvoiceSelectionMode $sourceInvoiceSelectionMode, ?\DateTimeImmutable $indebtednessPeriodFromDate, ?\DateTimeImmutable $indebtednessPeriodToDate, ?InvoiceLinkDto $sourceInvoices, ?InvoiceLinkDto $creditInvoices, ?InvoiceLinkDto $debitNotes, SalesPrepaymentCalculationDto $prepaymentCalculation, SalesInvoiceTotalPaymentsCalculationDto $invoiceTotalPaymentsCalculation, ?string $serviceId, int $invoiceId, int $senderId, ?string $sender, ?string $receiver, ?string $invoiceNumber, ?\DateTimeImmutable $accountingDateUtc, ?\DateTimeImmutable $paymentDateUtc, ?\DateTimeImmutable $invoiceDateUtc, ?\DateTimeImmutable $invoiceSentDateUtc, ?string $referenceNumber, float $fineRatePerDay, ?string $description, ?string $note, ?string $orderNumber, ?string $currency, float $discountPercentage, float $discountAmount, float $sumWithoutVat, float $vatRate, float $vatSum, float $sumWithVat, \DateTimeImmutable $createdUtc, \DateTimeImmutable $lastModifiedUtc, int $version, ?string $modelNumber)
    {
        $this->receiverId = $receiverId;
        $this->publicPurchaseContractSigner = $publicPurchaseContractSigner;
        $this->publicPurchaseContractSignerContractId = $publicPurchaseContractSignerContractId;
        $this->contract = $contract;
        $this->status = $status;
        $this->uasSender = $uasSender;
        $this->totalRowsCount = $totalRowsCount;
        $this->channel = $channel;
        $this->channelAddress = $channelAddress;
        $this->serviceProvider = $serviceProvider;
        $this->rows = $rows;

        if (IsStringLength::validate($invoiceMessage, 0, 500)) {
            throw new \RuntimeException('invalid.length.invoice_message');
        }
        $this->invoiceMessage = $invoiceMessage;

        if (IsStringLength::validate($acceptRejectMessage, 0, 500)) {
            throw new \RuntimeException('invalid.length.accept_reject_message');
        }
        $this->acceptRejectMessage = $acceptRejectMessage;

        $this->attachments = $attachments;
        $this->bankAccounts = $bankAccounts;
        $this->selectedPrepaymentInvoices = $selectedPrepaymentInvoices;
        $this->isCreditInvoice = $isCreditInvoice;
        $this->senderReceiverContractNumber = $senderReceiverContractNumber;
        $this->errorCode = $errorCode;
        $this->balanceDateUtc = $balanceDateUtc;
        $this->balanceBeginSum = $balanceBeginSum;
        $this->balanceInboundSum = $balanceInboundSum;
        $this->balanceOutboundSum = $balanceOutboundSum;
        $this->balanceEndSum = $balanceEndSum;
        $this->totalToPay = $totalToPay;
        $this->sendInvoiceToCir = $sendInvoiceToCir;
        $this->cirInvoiceId = $cirInvoiceId;
        $this->cirAmountChangeId = $cirAmountChangeId;
        $this->cirSettledAmount = $cirSettledAmount;
        $this->isProFormaInvoice = $isProFormaInvoice;
        $this->cirHistory = $cirHistory;
        $this->cirAssignationHistory = $cirAssignationHistory;
        $this->cirStatus = $cirStatus;
        $this->isDebitNote = $isDebitNote;
        $this->stornoNumber = $stornoNumber;
        $this->cancelInvoiceMessage = $cancelInvoiceMessage;
        $this->prepaymentInvoiceNumber = $prepaymentInvoiceNumber;
        $this->isPrepaymentInvoice = $isPrepaymentInvoice;
        $this->vatNotCalculated = $vatNotCalculated;
        $this->vatExemptionReasonId = $vatExemptionReasonId;
        $this->vatExemptionReasonKey = $vatExemptionReasonKey;
        $this->vatExemtionFreeFormNote = $vatExemtionFreeFormNote;
        $this->vatPointDate = $vatPointDate;
        $this->vatCategoryCode = $vatCategoryCode;
        $this->globUniqId = $globUniqId;
        $this->vatNumberFactoringCompany = $vatNumberFactoringCompany;
        $this->factoringContractNumber = $factoringContractNumber;
        $this->sourceInvoiceSelectionMode = $sourceInvoiceSelectionMode;
        $this->indebtednessPeriodFromDate = $indebtednessPeriodFromDate;
        $this->indebtednessPeriodToDate = $indebtednessPeriodToDate;
        $this->sourceInvoices = $sourceInvoices;
        $this->creditInvoices = $creditInvoices;
        $this->debitNotes = $debitNotes;
        $this->prepaymentCalculation = $prepaymentCalculation;
        $this->invoiceTotalPaymentsCalculation = $invoiceTotalPaymentsCalculation;
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
