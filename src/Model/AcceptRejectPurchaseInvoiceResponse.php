<?php

namespace i3or1s\EFakture\Model;

final class AcceptRejectPurchaseInvoiceResponse
{
    public readonly ChangeStatusInvoiceResponse $invoice;
    public readonly bool $success;

    public function __construct(ChangeStatusInvoiceResponse $invoice, bool $success)
    {
        $this->invoice = $invoice;
        $this->success = $success;
    }
}
