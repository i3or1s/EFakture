<?php

namespace Boris\EFakture\Model;

enum VatDeductionRight: string
{
    case NONE = 'None';
    case PARTIALLY = 'Partially';
    case FULLY = 'Fully';
}
