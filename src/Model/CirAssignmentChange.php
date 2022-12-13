<?php

namespace i3or1s\EFakture\Model;

enum CirAssignmentChange: string
{
    case ASSIGNMENT = 'Assignment';
    case CANCEL_ASSIGNMENT = 'CancelAssignment';
}
