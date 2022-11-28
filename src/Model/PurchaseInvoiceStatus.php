<?php

namespace Boris\EFakture\Model;

enum PurchaseInvoiceStatus: string
{
    case NEW = 'New';
    case SEEN = 'Seen';
    case REMINDED = 'Reminded';
    case RE_NOTIFIED = 'ReNotified';
    case RECEIVED = 'Received';
    case DELETED = 'Deleted';
    case APPROVED = 'Approved';
    case REJECTED = 'Rejected';
    case CANCELLED = 'Cancelled';
    case STORNO = 'Storno';
    case UNKNOWN = 'Unknown';
}
