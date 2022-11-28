<?php

namespace Boris\EFakture\Model;

final class InvoiceLinkDto
{
    public readonly ?string $invoiceId;
    public readonly ?string $cirInvoiceId;
    public readonly ?string $invoiceNumber;
    public readonly bool $sentToCir;
    public readonly SalesInvoiceStatus $status;

    public function __construct(?string $invoiceId, ?string $cirInvoiceId, ?string $invoiceNumber, bool $sentToCir, SalesInvoiceStatus $status)
    {
        $this->invoiceId = $invoiceId;
        $this->cirInvoiceId = $cirInvoiceId;
        $this->invoiceNumber = $invoiceNumber;
        $this->sentToCir = $sentToCir;
        $this->status = $status;
    }
}
