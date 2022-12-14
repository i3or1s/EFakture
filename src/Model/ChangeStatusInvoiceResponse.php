<?php

namespace i3or1s\EFakture\Model;

final class ChangeStatusInvoiceResponse
{
    public readonly ?string $invoiceNumber;
    public readonly PurchaseInvoiceStatus $status;

    public function __construct(?string $invoiceNumber, PurchaseInvoiceStatus $status)
    {
        $this->invoiceNumber = $invoiceNumber;
        $this->status = $status;
    }
}
