<?php

namespace i3or1s\EFakture\Util;

use i3or1s\EFakture\Model\Company;
use i3or1s\EFakture\Model\UnitMeasure;
use i3or1s\EFakture\Model\ValueAddedTaxExemptionReasonDto;
use i3or1s\EFakture\UBL\Invoice;

enum EFakturaAPIRoutes: string
{
    case GET_UNIT_MEASURES = '/api/publicApi/get-unit-measures';
    case GET_ALL_COMPANIES = '/api/publicApi/getAllCompanies';
    case SALES_INVOICE_UBL = '/api/publicApi/sales-invoice/ubl';
    case SALES_INVOICE_UBL_UPLOAD = '/api/publicApi/sales-invoice/ubl/upload';
    case VALUE_ADDED_TAX_EXEMPTION_LIST = '/api/publicApi/sales-invoice/getValueAddedTaxExemptionReasonList';

    public function SEFObject(): string
    {
        return match ($this) {
            EFakturaAPIRoutes::GET_UNIT_MEASURES => UnitMeasure::class,
            EFakturaAPIRoutes::GET_ALL_COMPANIES => Company::class,
            EFakturaAPIRoutes::SALES_INVOICE_UBL => Invoice::class,
            EFakturaAPIRoutes::VALUE_ADDED_TAX_EXEMPTION_LIST => ValueAddedTaxExemptionReasonDto::class,
            default => throw new \RuntimeException('Unsupported SEF model!')
        };
    }
}
