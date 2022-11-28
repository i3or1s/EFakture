<?php

namespace Boris\EFakture\Model;

enum UBLInvoiceDocumentType: string
{
    case PROFORMA_INVOICE = 'ProformaInvoice';
    case INVOICE = 'Invoice';
    case CREDIT_NOTE = 'CreditNote';
    case DEBIT_NOTE = 'DebitNote';
    case PREPAYMENT_INVOICE = 'PrepaymentInvoice';
}
