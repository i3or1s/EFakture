<?php

namespace i3or1s\EFakture\Model;

final class CompanyAccountOnEfAkturaDto
{
    public readonly bool $eFakturaRegisteredCompany;

    public function __construct(bool $eFakturaRegisteredCompany)
    {
        $this->eFakturaRegisteredCompany = $eFakturaRegisteredCompany;
    }
}
