<?php

namespace i3or1s\EFakture\Model;

enum SourceInvoiceSelectionMode: string
{
    case INVOICE_SELECTION = 'InvoiceSelection';
    case PERIOD_SELECTION = 'PeriodSelection';
}
