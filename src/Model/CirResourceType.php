<?php

namespace Boris\EFakture\Model;

enum CirResourceType: string
{
    case INVOICE = 'Invoice';
    case SETTLEMENT = 'Settlement';
}
