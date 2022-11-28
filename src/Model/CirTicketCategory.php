<?php

namespace Boris\EFakture\Model;

enum CirTicketCategory: string
{
    case INFORMATION = 'Information';
    case VALIDITY = 'Validity';
    case SETTLEMENT = 'Settlement';
    case CANCELLATION = 'Cancellation';
}
