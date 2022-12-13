<?php

namespace i3or1s\EFakture\Model;

enum VatDeductionRight: string
{
    case NONE = 'None';
    case PARTIALLY = 'Partially';
    case FULLY = 'Fully';
}
