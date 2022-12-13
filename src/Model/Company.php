<?php

namespace i3or1s\EFakture\Model;

final class Company implements SEFStorageInterface
{
    public readonly ?string $budgetCompanyNumber;
    public readonly ?string $registrationCode;
    public readonly ?string $vatRegistrationCode;
    public readonly string $name;

    public function __construct(?string $budgetCompanyNumber, ?string $registrationCode, ?string $vatRegistrationCode, string $name)
    {
        $this->budgetCompanyNumber = $budgetCompanyNumber;
        $this->registrationCode = $registrationCode;
        $this->vatRegistrationCode = $vatRegistrationCode;
        $this->name = $name;
    }

    /**
     * @return array{budgetCompanyNumber: ?string, registrationCode: ?string, vatRegistrationCode: ?string, name: string}
     */
    public function jsonSerialize(): array
    {
        return [
            'budgetCompanyNumber' => $this->budgetCompanyNumber,
            'registrationCode' => $this->registrationCode,
            'vatRegistrationCode' => $this->vatRegistrationCode,
            'name' => $this->name,
        ];
    }
}
