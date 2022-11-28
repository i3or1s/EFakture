<?php

namespace Boris\EFakture\Model;

enum SourceInvoiceSelectionMode: string
{
    case INVOICE_SELECTION = 'InvoiceSelection';
    case PERIOD_SELECTION = 'PeriodSelection';
}
