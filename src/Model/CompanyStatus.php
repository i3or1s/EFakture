<?php

namespace i3or1s\EFakture\Model;

enum CompanyStatus: string
{
    case ACTIVE = 'Active';
    case PASSIVE = 'Passive';
    case DELETED = 'Deleted';
    case MIGRATED = 'Migrated';
}
