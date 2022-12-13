<?php

namespace i3or1s\EFakture\Model;

use http\Exception\RuntimeException;
use i3or1s\EFakture\Util\IsStringLength;

final class SspEmailDto
{
    public readonly ?string $email; // min:0, max:100, email
    public readonly bool $isActivated;
    public readonly ?string $activationToken;

    public function __construct(?string $email, bool $isActivated, ?string $activationToken)
    {
        if (IsStringLength::validate($email, 0, 100)) {
            throw new RuntimeException('invalid.length.email');
        }
        $this->email = $email;

        $this->isActivated = $isActivated;
        $this->activationToken = $activationToken;
    }
}
