<?php

namespace i3or1s\EFakture\Model;

use http\Exception\RuntimeException;
use i3or1s\EFakture\Util\IsStringLength;

final class ContractCustomFieldDto
{
    public readonly int $id;
    public readonly ?string $name; // min:0, max: 50
    public readonly ?string $value;

    public function __construct(int $id, ?string $name, ?string $value)
    {
        $this->id = $id;

        if (!IsStringLength::validate($name, 0, 50)) {
            throw new RuntimeException('invalid.length.name');
        }
        $this->name = $name;

        $this->value = $value;
    }
}
