<?php

namespace i3or1s\EFakture\Model;

final class GroupVatListDto
{
    public readonly ?int $groupVatId;
    public readonly int $companyId;
    public readonly int $year;
    public readonly VatPeriod $vatPeriod;
    public readonly VatRecordingStatus $vatRecordingStatus;
    public readonly ?\DateTimeImmutable $sendDate;

    public function __construct(?int $groupVatId, int $companyId, int $year, VatPeriod $vatPeriod, VatRecordingStatus $vatRecordingStatus, ?\DateTimeImmutable $sendDate)
    {
        $this->groupVatId = $groupVatId;
        $this->companyId = $companyId;
        $this->year = $year;
        $this->vatPeriod = $vatPeriod;
        $this->vatRecordingStatus = $vatRecordingStatus;
        $this->sendDate = $sendDate;
    }
}
