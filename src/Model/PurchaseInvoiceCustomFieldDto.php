<?php

namespace Boris\EFakture\Model;

final class PurchaseInvoiceCustomFieldDto
{
    public readonly CustomFields $customField;
    public readonly ?string $value;

    public function __construct(CustomFields $customField, ?string $value)
    {
        $this->customField = $customField;
        $this->value = $value;
    }
}
