<?php

namespace Boris\EFakture\Model;

enum CompanyStatus: string
{
    case ACTIVE = 'Active';
    case PASSIVE = 'Passive';
    case DELETED = 'Deleted';
    case MIGRATED = 'Migrated';
}
