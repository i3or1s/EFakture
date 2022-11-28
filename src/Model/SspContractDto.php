<?php

namespace Boris\EFakture\Model;

use Boris\EFakture\Util\IsNumberInRange;
use Boris\EFakture\Util\IsStringLength;
use http\Exception\RuntimeException;

final class SspContractDto
{
    public readonly ?int $contractId;
    public readonly ?SspCustomerSupplierDto $customerSupplier;
    public readonly ?int $customerSupplierId;
    public readonly ?int $paymentTerms; // min:0, max: 9999
    public readonly ?float $fineRatePerDay; // min:0, max: 9999
    public readonly ?string $serviceId; // min:0, max: 20
    public readonly ?string $referenceNr; // min:0, max: 20
    public readonly ?string $contactPersonName; // min:0, max: 100
    public readonly ?string $contactPersonMail; // min:0, max: 100, email
    public readonly ?string $contractDesc;
    public readonly ?SspAddressDto $addresses;
    public readonly ?ContractCustomFieldDto $customFields;
    public readonly ?int $channels;
    public readonly bool $isDeleted;
    public readonly ?int $ownerCompanyId;
    public readonly ?int $channel;
    public readonly ?string $channelAddress;
    public readonly ?string $serviceProvider;
    public readonly ?int $contractNumber;
    public readonly ?string $invoiceNotificationEmail;
    public readonly ?string $invoiceCurrency; // min:0, max: 3
    public readonly bool $isBudgetClient;
    public readonly bool $sendInvoiceToCir;
    public readonly ?string $availableContracts;
    public readonly ContractApplicationDto $contractApplication;

    public function __construct(?int $contractId, ?SspCustomerSupplierDto $customerSupplier, ?int $customerSupplierId, ?int $paymentTerms, ?float $fineRatePerDay, ?string $serviceId, ?string $referenceNr, ?string $contactPersonName, ?string $contactPersonMail, ?string $contractDesc, ?SspAddressDto $addresses, ?ContractCustomFieldDto $customFields, ?int $channels, bool $isDeleted, ?int $ownerCompanyId, ?int $channel, ?string $channelAddress, ?string $serviceProvider, ?int $contractNumber, ?string $invoiceNotificationEmail, ?string $invoiceCurrency, bool $isBudgetClient, bool $sendInvoiceToCir, ?string $availableContracts, ContractApplicationDto $contractApplication)
    {
        $this->contractId = $contractId;
        $this->customerSupplier = $customerSupplier;
        $this->customerSupplierId = $customerSupplierId;

        if (!IsNumberInRange::range($paymentTerms, 0, 9999)) {
            throw new RuntimeException('invalid.length.payment_terms');
        }
        $this->paymentTerms = $paymentTerms;

        if (!IsNumberInRange::range($fineRatePerDay, 0, 9999)) {
            throw new RuntimeException('invalid.length.fine_rate_per_day');
        }
        $this->fineRatePerDay = $fineRatePerDay;

        if (!IsStringLength::validate($serviceId, 0, 20)) {
            throw new RuntimeException('invalid.length.service_id');
        }
        $this->serviceId = $serviceId;

        if (!IsStringLength::validate($referenceNr, 0, 20)) {
            throw new RuntimeException('invalid.length.reference_nr');
        }
        $this->referenceNr = $referenceNr;

        if (!IsStringLength::validate($contactPersonName, 0, 100)) {
            throw new RuntimeException('invalid.length.contact_person_name');
        }
        $this->contactPersonName = $contactPersonName;

        if (!IsStringLength::validate($contactPersonMail, 0, 100)) {
            throw new RuntimeException('invalid.length.contact_person_mail');
        }
        $this->contactPersonMail = $contactPersonMail;

        $this->contractDesc = $contractDesc;
        $this->addresses = $addresses;
        $this->customFields = $customFields;
        $this->channels = $channels;
        $this->isDeleted = $isDeleted;
        $this->ownerCompanyId = $ownerCompanyId;
        $this->channel = $channel;
        $this->channelAddress = $channelAddress;
        $this->serviceProvider = $serviceProvider;
        $this->contractNumber = $contractNumber;
        $this->invoiceNotificationEmail = $invoiceNotificationEmail;

        if (!IsStringLength::validate($invoiceCurrency, 0, 3)) {
            throw new RuntimeException('invalid.length.invoice_currency');
        }
        $this->invoiceCurrency = $invoiceCurrency;

        $this->isBudgetClient = $isBudgetClient;
        $this->sendInvoiceToCir = $sendInvoiceToCir;
        $this->availableContracts = $availableContracts;
        $this->contractApplication = $contractApplication;
    }
}
