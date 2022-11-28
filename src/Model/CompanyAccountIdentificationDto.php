<?php

namespace Boris\EFakture\Model;

final class CompanyAccountIdentificationDto
{
    public readonly ?string $registrationNumber;
    public readonly ?string $jbkjs;
    public readonly ?string $vatNumber;

    public function __construct(?string $registrationNumber, ?string $jbkjs, ?string $vatNumber)
    {
        $this->registrationNumber = $registrationNumber;
        $this->jbkjs = $jbkjs;
        $this->vatNumber = $vatNumber;
    }
}
