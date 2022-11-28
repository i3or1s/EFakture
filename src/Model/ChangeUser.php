<?php

namespace Boris\EFakture\Model;

final class ChangeUser
{
    public readonly ?string $firstName;
    public readonly ?string $lastName;

    public function __construct(?string $firstName, ?string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
