<?php

namespace Boris\EFakture\Model;

enum SerbiaCompanyType: string
{
    case COMPANY = 'Company';
    case SOLE_PROPRIETOR = 'SoleProprietor';
    case ASSOCIATION = 'Association';
    case BANCROPCY_ESTATE = 'BancropcyEstate';
    case FOUNDATION = 'Foundation';
    case SPORTS_ASSOCIATION = 'SportsAssociation';
    case CHAMBER = 'Chamber';
    case BUDGETUSER = 'BudgetUser';
    case OTHER = 'Other';
}
