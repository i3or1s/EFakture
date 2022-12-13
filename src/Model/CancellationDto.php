<?php

namespace i3or1s\EFakture\Model;

final class CancellationDto
{
    public readonly ?\DateTimeImmutable $cancelDate;
    public readonly ?int $cancelledBy;
    public readonly ?string $reason;

    public function __construct(?\DateTimeImmutable $cancelDate, ?int $cancelledBy, ?string $reason)
    {
        $this->cancelDate = $cancelDate;
        $this->cancelledBy = $cancelledBy;
        $this->reason = $reason;
    }
}
