<?php

namespace i3or1s\EFakture\Model;

final class AcceptRejectResponse
{
    public readonly ?string $message;
    public readonly ?string $httpStatus;
    public readonly ChangeStatusInvoiceResponse $invoice;
    public readonly bool $success;

    public function __construct(?string $message, ?string $httpStatus, ChangeStatusInvoiceResponse $invoice, bool $success)
    {
        $this->message = $message;
        $this->httpStatus = $httpStatus;
        $this->invoice = $invoice;
        $this->success = $success;
    }
}
