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
    case SALES_INVOICE_IDS = '/api/publicApi/sales-invoice/ids';
    case SALES_INVOICE = '/api/publicApi/sales-invoice';
    case SALES_INVOICE_XML = '/api/publicApi/sales-invoice/xml';
    case PURCHASE_INVOICE_IDS = '/api/publicApi/purchase-invoice/ids';
    case PURCHASE_INVOICE = '/api/publicApi/purchase-invoice';
    case PURCHASE_INVOICE_XML = '/api/publicApi/purchase-invoice/xml';
    case VALUE_ADDED_TAX_EXEMPTION_LIST = '/api/publicApi/sales-invoice/getValueAddedTaxExemptionReasonList';
    case SALES_INVOICE_CANCEL = '/api/publicApi/sales-invoice/cancel';
    case SALES_INVOICE_STORNO = '/api/publicApi/sales-invoice/storno';
    case SALES_INVOICE_CHANGES = '/api/publicApi/sales-invoice/changes';
    case COMPANY_REGISTERED = '/api/publicApi/Company/CheckIfCompanyRegisteredOnEfaktura';

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
