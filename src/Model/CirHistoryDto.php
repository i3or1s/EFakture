<?php

namespace i3or1s\EFakture\Model;

final class CirHistoryDto
{
    public readonly ?string $comment;
    public readonly AssignmentDto $assignment;
    public readonly ?AmountChangeDto $amountChanges;
    public readonly CancellationDto $cancellation;
    public readonly SettlementDto $settlements;

    public function __construct(?string $comment, AssignmentDto $assignment, ?AmountChangeDto $amountChanges, CancellationDto $cancellation, SettlementDto $settlements)
    {
        $this->comment = $comment;
        $this->assignment = $assignment;
        $this->amountChanges = $amountChanges;
        $this->cancellation = $cancellation;
        $this->settlements = $settlements;
    }
}
