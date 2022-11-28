<?php

namespace Boris\EFakture\Model;

use Boris\EFakture\Util\IsStringLength;

final class CompanyDto
{
    public readonly int $companyId;
    public readonly int $countryId;
    public readonly string $name;
    public readonly ?string $webAddress;
    public readonly ?SspAddressDto $addresses;
    public readonly ?SspBankAccountDto $bankAccounts;
    public readonly ?SspEmailDto $emails;
    public readonly string $registrationCode;
    public readonly ?string $vatRegistrationCode; // min:0, max:15
    public readonly ?string $phoneNumber;
    public readonly ?string $contactPerson;
    public readonly ?string $contactEmail;
    public readonly ?string $logo;
    public readonly CompanySettingsDto $settings;
    public readonly bool $isMainCompany;
    public readonly ?int $groupId;
    public readonly bool $isPrivateCompany;
    public readonly int $packageId;
    public readonly ?string $additionalCode;
    public readonly bool $plusChannelsActive;
    public readonly CompanyStatus $status;
    public readonly ?\DateTimeImmutable $companyWillBeDeletedAt;
    public readonly SerbiaCompanyType $serbiaCompanyType;
    public readonly bool $nonSebIbanWarning;
    public readonly ?bool $storeInvoiceDetails;
    public readonly ?bool $hasISP;
    public readonly ?int $informationServiceProviderId;
    public readonly ?string $informationServiceProviderName;
    public readonly ?bool $ispAcceptedToRepresentCompany;

    public function __construct(int $companyId, int $countryId, string $name, ?string $webAddress, ?SspAddressDto $addresses, ?SspBankAccountDto $bankAccounts, ?SspEmailDto $emails, string $registrationCode, ?string $vatRegistrationCode, ?string $phoneNumber, ?string $contactPerson, ?string $contactEmail, ?string $logo, CompanySettingsDto $settings, bool $isMainCompany, ?int $groupId, bool $isPrivateCompany, int $packageId, ?string $additionalCode, bool $plusChannelsActive, CompanyStatus $status, ?\DateTimeImmutable $companyWillBeDeletedAt, SerbiaCompanyType $serbiaCompanyType, bool $nonSebIbanWarning, ?bool $storeInvoiceDetails, ?bool $hasISP, ?int $informationServiceProviderId, ?string $informationServiceProviderName, ?bool $ispAcceptedToRepresentCompany)
    {
        $this->companyId = $companyId;
        $this->countryId = $countryId;
        $this->name = $name;
        $this->webAddress = $webAddress;
        $this->addresses = $addresses;
        $this->bankAccounts = $bankAccounts;
        $this->emails = $emails;
        $this->registrationCode = $registrationCode;

        if (IsStringLength::validate($vatRegistrationCode, 0, 15)) {
            throw new \RuntimeException('invalid.length.vat_registration_code');
        }
        $this->vatRegistrationCode = $vatRegistrationCode;

        $this->phoneNumber = $phoneNumber;
        $this->contactPerson = $contactPerson;
        $this->contactEmail = $contactEmail;
        $this->logo = $logo;
        $this->settings = $settings;
        $this->isMainCompany = $isMainCompany;
        $this->groupId = $groupId;
        $this->isPrivateCompany = $isPrivateCompany;
        $this->packageId = $packageId;
        $this->additionalCode = $additionalCode;
        $this->plusChannelsActive = $plusChannelsActive;
        $this->status = $status;
        $this->companyWillBeDeletedAt = $companyWillBeDeletedAt;
        $this->serbiaCompanyType = $serbiaCompanyType;
        $this->nonSebIbanWarning = $nonSebIbanWarning;
        $this->storeInvoiceDetails = $storeInvoiceDetails;
        $this->hasISP = $hasISP;
        $this->informationServiceProviderId = $informationServiceProviderId;
        $this->informationServiceProviderName = $informationServiceProviderName;
        $this->ispAcceptedToRepresentCompany = $ispAcceptedToRepresentCompany;
    }
}
