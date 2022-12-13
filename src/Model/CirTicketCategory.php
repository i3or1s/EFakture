<?php

namespace i3or1s\EFakture\Model;

enum CirTicketCategory: string
{
    case INFORMATION = 'Information';
    case VALIDITY = 'Validity';
    case SETTLEMENT = 'Settlement';
    case CANCELLATION = 'Cancellation';
}
