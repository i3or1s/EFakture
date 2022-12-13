<?php

namespace i3or1s\EFakture\Model;

enum CirTicketSortEnum: string
{
    case CIR_ID = 'CirId';
    case COMPANY_NUMBER = 'CompanyNumber';
    case ORGANIZATION_NAME = 'OrganizationName';
    case DATA = 'Data';
    case CREATION_DATE = 'CreationDate';
    case CLOSING_DATE = 'ClosingDate';
}
