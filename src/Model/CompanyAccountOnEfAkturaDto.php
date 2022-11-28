<?php

namespace Boris\EFakture\Model;

final class CompanyAccountOnEfAkturaDto
{
    public readonly bool $eFakturaRegisteredCompany;

    public function __construct(bool $eFakturaRegisteredCompany)
    {
        $this->eFakturaRegisteredCompany = $eFakturaRegisteredCompany;
    }
}
