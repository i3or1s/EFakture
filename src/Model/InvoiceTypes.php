<?php

namespace i3or1s\EFakture\Model;

enum InvoiceTypes: string
{
    case REGULAR = 'Regular';
    case CREDIT = 'Credit';
    case DEBIT_NOTE = 'DebitNote';
    case PREPAYMENT = 'Prepayment';
}
