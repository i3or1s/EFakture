<?php

namespace Boris\EFakture\Model;

final class Header
{
    public readonly ?string $clientInvoiceNumber;
    public readonly ?string $internalInvoiceId;
    public readonly Extension $extensions;

    public function __construct(?string $clientInvoiceNumber, ?string $internalInvoiceId, Extension $extensions)
    {
        $this->clientInvoiceNumber = $clientInvoiceNumber;
        $this->internalInvoiceId = $internalInvoiceId;
        $this->extensions = $extensions;
    }
}
