<?php

namespace Boris\EFakture\Model;

enum CirAssignmentChange: string
{
    case ASSIGNMENT = 'Assignment';
    case CANCEL_ASSIGNMENT = 'CancelAssignment';
}
