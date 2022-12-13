<?php

namespace i3or1s\EFakture\Model;

enum SalesInvoiceStatus: string
{
    case NEW = 'New';
    case DRAFT = 'Draft';
    case SENT = 'Sent';
    case PAID = 'Paid';
    case MISTAKE = 'Mistake';
    case OVERDUE = 'OverDue';
    case ARCHIVED = 'Archived';
    case SENDING = 'Sending';
    case DELETED = 'Deleted';
    case APPROVED = 'Approved';
    case REJECTED = 'Rejected';
    case CANCELLED = 'Cancelled';
    case STORNO = 'Storno';
    case UNKNOWN = 'Unknown';
}
