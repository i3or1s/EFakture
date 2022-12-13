<?php

namespace i3or1s\EFakture\Model;

enum SspModules: string
{
    case ROOT = 'root';
    case DASHBOARD = 'dashboard';
    case SALES_INVOICES = 'salesInvoices';
    case SALES_INVOICE_NEW = 'salesInvoiceNew';
    case SALES_INVOICE_EDIT = 'salesInvoiceEdit';
    case SALES_INVOICE_PREVIEW = 'salesInvoicePreview';
    case SALES_INVOICE_VIEW = 'salesInvoiceView';
    case PURCHASES = 'purchases';
    case PURCHASE_INVOICE_EDIT = 'purchaseInvoiceEdit';
    case PURCHASE_INVOICE_PUBLIC = 'purchaseInvoicePublic';
    case SETTINGS = 'settings';
    case LOGIN = 'login';
    case MYDETAILS = 'myDetails';
    case USERSLIST = 'usersList';
    case USEREDIT = 'userEdit';
    case REGISTERS = 'registers';
    case BILLING = 'billing';
    case COMPANY_DETAILS = 'companyDetails';
    case CONTACTS_LIST = 'contactsList';
    case INVOICE_SETTINGS = 'invoiceSettings';
    case PRODUCTS_LIST = 'productsList';
    case PRODUCT_EDIT = 'productEdit';
    case SEARCH_RESULTS = 'searchResults';
    case CONVERSATION = 'conversation';
    case FILES = 'files';
    case FILES_ADD = 'filesAdd';
    case FILES_EDIT = 'filesEdit';
    case SALES_INVOICE_UPLOAD = 'salesInvoiceUpload';
    case COMPANY_LIST = 'companyList';
    case TUNNEL_PAGE = 'tunnelPage';
    case PACKAGES = 'packages';
    case CONTACTS_EDIT = 'contactsEdit';
    case API_MANAGEMENT = 'apiManagement';
    case SALES_ATTACHMENT_UPLOAD = 'salesAttachmentUpload';
    case INVOICE_MESSAGES = 'invoiceMessages';
    case ADD_COMPANY = 'addCompany';
    case CONTRACT_APPLICATIONS = 'contractApplications';
    case CONTRACT_APPLICATIONS_UPDATE = 'contractApplicationsUpdate';
    case SALES_INVOICE_COPY = 'salesInvoiceCopy';
    case COMPANY_NAME_FROM_REGISTER = 'companyNameFromRegister';
    case SALES_INVOICE_CIR_EDIT = 'salesInvoiceCirEdit';
    case PURCHASE_INVOICE_CIR_EDIT = 'purchaseInvoiceCirEdit';
    case CHANGE_PACKAGE = 'changePackage';
    case ONE_CLIC_KORDER = 'oneClickOrder';
    case COMPANY_LOGO = 'companyLogo';
    case CIR_TICKETS = 'cirTickets';
    case CIR_TICKET_DETAILS = 'cirTicketDetails';
    case CIR_TICKET_NEW = 'cirTicketNew';
    case GROUP_VAT = 'groupVat';
    case GROUP_VAT_EDIT = 'groupVatEdit';
    case SINGLE_VAT = 'singleVat';
    case SINGLE_VAT_EDIT = 'singleVatEdit';
    case ISP_SETTINGS = 'ispSettings';
    case PUBLIC_PURCHASE_CONTRACTOR_INVOICES = 'publicPurchaseContractorInvoices';
    case ISP_CONFIGURATION = 'ispConfiguration';
}
