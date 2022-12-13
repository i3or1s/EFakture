<?php

namespace i3or1s\EFakture\Model;

enum CirResourceType: string
{
    case INVOICE = 'Invoice';
    case SETTLEMENT = 'Settlement';
}
