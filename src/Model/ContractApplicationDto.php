<?php

namespace Boris\EFakture\Model;

final class ContractApplicationDto
{
    public readonly ?int $contractApplicationId;
    public readonly ?string $companyName;
    public readonly ?string $registrationCode;
    public readonly ?string $vatRegistrationCode;
    public readonly ?string $serviceId;
    public readonly ?SspAddressDto $addresses;
    public readonly ?int $channel;
    public readonly ?string $channelAddress;
    public readonly ?string $invoiceNotificationEmail;
    public readonly ?string $serviceProvider;
    public readonly ?int $paymentTerms;
    public readonly ?float $fineRatePerDay;
    public readonly ?string $referenceNr;
    public readonly ?\DateTimeImmutable $contractDate;
    public readonly ?string $companyLabel;
    public readonly ?string $companyEmail;
    public readonly ?string $companyPhone;
    public readonly ?string $contactPersonName;
    public readonly ?string $contactPersonEmail;
    public readonly ?int $receiverCompanyId;

    public function __construct(?int $contractApplicationId, ?string $companyName, ?string $registrationCode, ?string $vatRegistrationCode, ?string $serviceId, ?SspAddressDto $addresses, ?int $channel, ?string $channelAddress, ?string $invoiceNotificationEmail, ?string $serviceProvider, ?int $paymentTerms, ?float $fineRatePerDay, ?string $referenceNr, ?\DateTimeImmutable $contractDate, ?string $companyLabel, ?string $companyEmail, ?string $companyPhone, ?string $contactPersonName, ?string $contactPersonEmail, ?int $receiverCompanyId)
    {
        $this->contractApplicationId = $contractApplicationId;
        $this->companyName = $companyName;
        $this->registrationCode = $registrationCode;
        $this->vatRegistrationCode = $vatRegistrationCode;
        $this->serviceId = $serviceId;
        $this->addresses = $addresses;
        $this->channel = $channel;
        $this->channelAddress = $channelAddress;
        $this->invoiceNotificationEmail = $invoiceNotificationEmail;
        $this->serviceProvider = $serviceProvider;
        $this->paymentTerms = $paymentTerms;
        $this->fineRatePerDay = $fineRatePerDay;
        $this->referenceNr = $referenceNr;
        $this->contractDate = $contractDate;
        $this->companyLabel = $companyLabel;
        $this->companyEmail = $companyEmail;
        $this->companyPhone = $companyPhone;
        $this->contactPersonName = $contactPersonName;
        $this->contactPersonEmail = $contactPersonEmail;
        $this->receiverCompanyId = $receiverCompanyId;
    }
}
