<?php

namespace Boris\EFakture\Model;

final class RestrictionItem
{
    public readonly eRestrictionField $field;
    public readonly ?string $values;

    public function __construct(eRestrictionField $field, ?string $values)
    {
        $this->field = $field;
        $this->values = $values;
    }
}
