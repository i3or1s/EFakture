<?php

namespace Boris\EFakture\Model;

enum eRestrictionField: string
{
    case GENERAL = 'General';
    case INVOICE_SENDER_LIKE = 'Invoice_Sender_Like';
    case INVOICE_RECEIVER_LIKE = 'Invoice_Receiver_Like';
    case INVOICE_INVOICE_NUMBER_LIKE = 'Invoice_InvoiceNumber_Like';
    case INVOICE_INVOICE_NUMBER_EQUALS = 'Invoice_InvoiceNumber_Equals';
    case INVOICE_ACCOUNTING_DATE_UTC_BEFORE = 'Invoice_AccountingDateUtc_Before';
    case INVOICE_ACCOUNTING_DATE_UTC_AFTER = 'Invoice_AccountingDateUtc_After';
    case INVOICE_INVOICE_SENT_DATE_UTC_BEFORE = 'Invoice_InvoiceSentDateUtc_Before';
    case INVOICE_INVOICE_SENT_DATE_UTC_AFTER = 'Invoice_InvoiceSentDateUtc_After';
    case INVOICE_PAYMENT_DATE_UTC_BEFORE = 'Invoice_PaymentDateUtc_Before';
    case INVOICE_PAYMENT_DATE_UTC_AFTER = 'Invoice_PaymentDateUtc_After';
    case INVOICE_REFERENCE_NUMBER_LIKE = 'Invoice_ReferenceNumber_Like';
    case INVOICE_DESCRIPTION_LIKE = 'Invoice_Description_Like';
    case INVOICE_NOTE_LIKE = 'Invoice_Note_Like';
    case INVOICE_ORDER_NUMBER_LIKE = 'Invoice_OrderNumber_Like';
    case ROW_CODE_LIKE = 'Row_Code_Like';
    case ROW_DESCRIPTION_LIKE = 'Row_Description_Like';
    case ROW_UNIT_LIKE = 'Row_Unit_Like';
    case INVOICE_STATUS = 'Invoice_Status';
    case INVOICE_SERVICE_ID = 'Invoice_ServiceId';
    case INVOICE_CHANNEL = 'Invoice_Channel';
    case INVOICE_CHANNEL_ADRESS = 'Invoice_ChannelAdress';
    case INVOICE_INVOICE_TYPE = 'Invoice_InvoiceType';
    case INVOICE_SENT_TO_CIR = 'Invoice_SentToCir';
}
