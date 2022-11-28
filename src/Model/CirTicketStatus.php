<?php

namespace Boris\EFakture\Model;

enum CirTicketStatus: string
{
    case ACTIVE = 'Active';
    case CANCELED = 'Canceled';
    case SOLVED = 'Solved';
    case UNSOLVED = 'Unsolved';
}
