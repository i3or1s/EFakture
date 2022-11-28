<?php

namespace Boris\EFakture\Model;

final class AmountChangeDto
{
    public readonly ?string $comments;
    public readonly ?float $amount;
    public readonly ?\DateTimeImmutable $cancelDate;
    public readonly ?\DateTimeImmutable $creationDate;
    public readonly ?string $cancelComments;
    public readonly int $changedId;
    public readonly int $id;

    public function __construct(?string $comments, ?float $amount, ?\DateTimeImmutable $cancelDate, ?\DateTimeImmutable $creationDate, ?string $cancelComments, int $changedId, int $id)
    {
        $this->comments = $comments;
        $this->amount = $amount;
        $this->cancelDate = $cancelDate;
        $this->creationDate = $creationDate;
        $this->cancelComments = $cancelComments;
        $this->changedId = $changedId;
        $this->id = $id;
    }
}
