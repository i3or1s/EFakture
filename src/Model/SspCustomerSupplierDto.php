<?php

namespace Boris\EFakture\Model;

use Boris\EFakture\Util\IsStringLength;
use http\Exception\RuntimeException;

final class SspCustomerSupplierDto
{
    public readonly int $customerSupplierId;
    public readonly ?int $ownerCompanyId;
    public readonly ?int $countryId;
    public readonly ?string $companyName; // min:0, max:200
    public readonly ?string $registrationCode; // min:0, max:15
    public readonly ?string $vatRegistrationCode; // min:0, max:100
    public readonly ?string $firstName;
    public readonly ?string $lastName;
    public readonly ?string $personalId;
    public readonly ?string $phoneNumber; // min:0, max:20
    public readonly ?bool $isCompany;
    public readonly ?string $companyMail; // min:0, max:100, email
    public readonly ?string $email; // min:0, max:200, email
    public readonly Languages $language;
    public readonly ?string $additionalCode;

    public function __construct(int $customerSupplierId, ?int $ownerCompanyId, ?int $countryId, ?string $companyName, ?string $registrationCode, ?string $vatRegistrationCode, ?string $firstName, ?string $lastName, ?string $personalId, ?string $phoneNumber, ?bool $isCompany, ?string $companyMail, ?string $email, Languages $language, ?string $additionalCode)
    {
        $this->customerSupplierId = $customerSupplierId;
        $this->ownerCompanyId = $ownerCompanyId;
        $this->countryId = $countryId;

        if (!IsStringLength::validate($companyName, 0, 200)) {
            throw new RuntimeException('invalid.length.company_name');
        }
        $this->companyName = $companyName;

        if (!IsStringLength::validate($registrationCode, 0, 15)) {
            throw new RuntimeException('invalid.length.registration_code');
        }
        $this->registrationCode = $registrationCode;

        if (!IsStringLength::validate($vatRegistrationCode, 0, 100)) {
            throw new RuntimeException('invalid.length.vat_registration_code');
        }
        $this->vatRegistrationCode = $vatRegistrationCode;

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->personalId = $personalId;

        if (!IsStringLength::validate($phoneNumber, 0, 20)) {
            throw new RuntimeException('invalid.length.phone_number');
        }
        $this->phoneNumber = $phoneNumber;

        $this->isCompany = $isCompany;

        if (!IsStringLength::validate($companyMail, 0, 100)) {
            throw new RuntimeException('invalid.length.company_mail');
        }
        $this->companyMail = $companyMail;

        if (!IsStringLength::validate($email, 0, 200)) {
            throw new RuntimeException('invalid.length.email');
        }
        $this->email = $email;

        $this->language = $language;
        $this->additionalCode = $additionalCode;
    }
}
