<?php

namespace Boris\EFakture\Model;

final class CirTicketSearchEnumRestrictionItem
{
    public readonly CirTicketSearchEnum $field;
    public readonly ?string $values;

    public function __construct(CirTicketSearchEnum $field, ?string $values)
    {
        $this->field = $field;
        $this->values = $values;
    }
}
