<?php

namespace i3or1s\EFakture\Model;

final class GroupVatDto
{
    public readonly ?int $groupVatId;
    public readonly int $companyId;
    public readonly int $year;
    public readonly VatPeriod $vatPeriod;
    public readonly VatRecordingStatus $vatRecordingStatus;
    public readonly VatTurnoverDto $turnoverWithFee;
    public readonly VatTurnoverDto $turnoverWithoutFee;
    public readonly ?float $vatReductionFromPreviousPeriodAmount;
    public readonly ?float $vatIncreaseFromPreviousPeriodAmount;
    public readonly ?\DateTimeImmutable $sendDate;

    public function __construct(?int $groupVatId, int $companyId, int $year, VatPeriod $vatPeriod, VatRecordingStatus $vatRecordingStatus, VatTurnoverDto $turnoverWithFee, VatTurnoverDto $turnoverWithoutFee, ?float $vatReductionFromPreviousPeriodAmount, ?float $vatIncreaseFromPreviousPeriodAmount, ?\DateTimeImmutable $sendDate)
    {
        $this->groupVatId = $groupVatId;
        $this->companyId = $companyId;
        $this->year = $year;
        $this->vatPeriod = $vatPeriod;
        $this->vatRecordingStatus = $vatRecordingStatus;
        $this->turnoverWithFee = $turnoverWithFee;
        $this->turnoverWithoutFee = $turnoverWithoutFee;
        $this->vatReductionFromPreviousPeriodAmount = $vatReductionFromPreviousPeriodAmount;
        $this->vatIncreaseFromPreviousPeriodAmount = $vatIncreaseFromPreviousPeriodAmount;
        $this->sendDate = $sendDate;
    }
}
