<?php

namespace Boris\EFakture\Model;

final class AssignmentDto
{
    public readonly ?string $assignmentContractNr;
    public readonly ?string $assignmentDebtorName;
    public readonly ?string $assignmentDebtorCompanyNr;
    public readonly ?string $assignmentIdfNr;
    public readonly ?string $originalIdfNr;

    public function __construct(?string $assignmentContractNr, ?string $assignmentDebtorName, ?string $assignmentDebtorCompanyNr, ?string $assignmentIdfNr, ?string $originalIdfNr)
    {
        $this->assignmentContractNr = $assignmentContractNr;
        $this->assignmentDebtorName = $assignmentDebtorName;
        $this->assignmentDebtorCompanyNr = $assignmentDebtorCompanyNr;
        $this->assignmentIdfNr = $assignmentIdfNr;
        $this->originalIdfNr = $originalIdfNr;
    }
}
