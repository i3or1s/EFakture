<?php

namespace Boris\EFakture\Model;

enum CirTicketSearchEnum: string
{
    case CIR_ID = 'CirId';
    case COMPANY_NUMBER = 'CompanyNumber';
    case COMPANY_NAME = 'CompanyName';
    case DATA = 'Data';
    case CREATIN_DATE_FROM = 'CreatinDateFrom';
    case CREATIN_DATE_TO = 'CreatinDateTo';
    case CLOSING_DATE_FROM = 'ClosingDateFrom';
    case CLOSING_DATE_TO = 'ClosingDateTo';
    case STATUS = 'Status';
    case ISSUE_TYPE = 'IssueType';
}
