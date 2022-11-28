<?php

namespace Boris\EFakture\Model;

enum eSortColumn: string
{
    case INVOICE_INVOICE_ID = 'Invoice_InvoiceId';
    case INVOICE_SENDER_NAME = 'Invoice_SenderName';
    case INVOICE_RECEIVER_NAME = 'Invoice_ReceiverName';
    case INVOICE_ACCOUNTING_DATE_UTC = 'Invoice_AccountingDateUtc';
    case INVOICE_INVOICE_DATE_UTC = 'Invoice_InvoiceDateUtc';
    case INVOICE_PAYMENT_DATE_UTC = 'Invoice_PaymentDateUtc';
    case INVOICE_SUM_WITHOUT_VAT = 'Invoice_SumWithoutVat';
    case INVOICE_VAT_RATE = 'Invoice_VatRate';
    case INVOICE_VAT_SUM = 'Invoice_VatSum';
    case INVOICE_SUM_WITH_VAT = 'Invoice_SumWithVat';
    case INVOICE_REFERENCE_NUMBER = 'Invoice_ReferenceNumber';
    case INVOICE_DESCRIPTION = 'Invoice_Description';
    case INVOICE_ORDER_NUMBER = 'Invoice_OrderNumber';
    case INVOICE_INVOICE_NUMBER = 'Invoice_InvoiceNumber';
    case INVOICE_STATUS = 'Invoice_Status';
    case INVOICE_SERVICE_ID = 'Invoice_ServiceId';
    case INVOICE_CHANNEL_ID = 'Invoice_ChannelId';
    case INVOICE_CHANNEL_ADRESS = 'Invoice_ChannelAdress';
    case INVOICE_DOCUMENT_TYPE = 'Invoice_DocumentType';
    case INVOICE_INVOICE_SENT_DATE_UTC = 'Invoice_InvoiceSentDateUtc';
    case INVOICE_INVOICE_TYPE = 'Invoice_InvoiceType';
}
