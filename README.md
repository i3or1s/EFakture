# Library for "Sistem elektronskih faktura"

List of services that make use of **SEF API** to send invoices.

Installation
------------
* [Install library][1] with Composer
* This library is in beta. Versioning is yet to be supported

Contributing
------------
EFakture is an Open Source library that will remain free.
You are most welcomed to create issues and pull requests on github.

Licence
------------
At this moment there is no special licence attached to this product.
This will be addressed in the future.
There is no intention to limit or in any way disrupt the usage of the library.

Code organization
------------
System depends on the UBL standard to create the objects that are to be sent to SEF.  
[UBL implementation][2] that library depends on.  
All responses from the **SEF** are built as objects in the [Model][3] directory.
Storing response results from the **SEF** is currently done in file system.
Support for other types of storage is covered through the use of [StorageInterface][4]  
Cache folder is by default in location `/tmp/sefStorage`.  
Some of **SEF** responses are large so API can take some time to cache.

[UBL][5] directory contains adapters over standard UBL formats for the purpose of
constructing the UBL for **SEF** and removing the complexity of class instantiation.

Example usage
------------
### Initial setup before every API call
```php
$browser = new \React\Http\Browser(); // Used for all the API calls
$apiKey = '*****'; // Obtain key from SEF
$apiService = new \i3or1s\EFakture\Util\EFaktureApi($browser, $apiKey); // Set of available API calls
```

### Retrieve available units
```php
$UnitMeasures = new \i3or1s\EFakture\Service\UnitMeasures();
$measures = $UnitMeasures->retrieve($apiService);
print_r($measures);
```

### Retrieve available companies
```php
$storageManager = new \i3or1s\EFakture\Storage\StorageManager(new \i3or1s\EFakture\Storage\FileSystemStorage(__DIR__.'/cache'));
$companies = new \i3or1s\EFakture\Service\Companies();
$companiesResourceStream = new \i3or1s\EFakture\ResourceStream\FileSystemResourceStream($storageManager->storage, EFakturaAPIRoutes::GET_ALL_COMPANIES->SEFObject());

$listOfCompanies = $companies->retrieve($apiService, $companiesResourceStream, 0,3);
print_r($listOfCompanies);
```

### Find company
For this call to work you should have generated list of companies in the cache.
```php
$storageManager = new \i3or1s\EFakture\Storage\StorageManager(new \i3or1s\EFakture\Storage\FileSystemStorage(__DIR__.'/cache', true));
$companies = new \i3or1s\EFakture\Service\Companies();
$companiesResourceStream = new \i3or1s\EFakture\ResourceStream\FileSystemResourceStream($storageManager->storage, EFakturaAPIRoutes::GET_ALL_COMPANIES->SEFObject());

$listOfCompanies = $companiesResourceStream->getStorageInterface()->seek(EFakturaAPIRoutes::GET_ALL_COMPANIES->SEFObject(), [
    "registrationCode" => "08804516"
]);
print_r($listOfCompanies);
```

### Retrieve TAX exemption reasons
For this call to work you should have generated list of companies in the cache.
```php
$storageManager = new \i3or1s\EFakture\Storage\StorageManager(new \i3or1s\EFakture\Storage\FileSystemStorage(__DIR__.'/cache'));
$taxExemptionListService = new \i3or1s\EFakture\Service\ValueAddedTaxExemptionReasonList();
$taxExemptionResourceStream = new \i3or1s\EFakture\ResourceStream\FileSystemResourceStream($storageManager->storage, EFakturaAPIRoutes::VALUE_ADDED_TAX_EXEMPTION_LIST->SEFObject());
$taxExemptionList = $taxExemptionListService->retrieve($apiService, $taxExemptionResourceStream, 0,1);
print_r($taxExemptionList);
```

### Create and send invoice
Note: Company data should be valid in SEF in order for this to work
```php
$invoice = new \i3or1s\EFakture\UBL\Invoice(
    new \i3or1s\EFakture\UBL\InvoiceDetails(
        \Ramsey\Uuid\Uuid::uuid4(), new DateTimeImmutable(), new DateTimeImmutable('+ 7days'), new \i3or1s\EFakture\UBL\CBC\InvoiceTypeCode(\i3or1s\EFakture\UBL\CBC\InvoiceTypeCode::COMMERCIAL_INVOICE),
        'RSD', new \i3or1s\EFakture\UBL\CAC\InvoicePeriod(\i3or1s\EFakture\UBL\CAC\InvoicePeriod::DELIVERY_ACTUAL_DATE),
        '123456', new DateTimeImmutable('+ 7days')

    ),
    new \i3or1s\EFakture\UBL\Party(
        'company PIB', null, 'company name', null, 'city', 'RS',
        'company Identification', 'e-mail address', true
    ),
    new \i3or1s\EFakture\UBL\Party(
        'company PIB', null, 'company name', 'address', 'city',
        'RS','company Identification', 'e-mail address', true
    ),
    new \i3or1s\EFakture\UBL\PaymentMeans(
        '30', '(mod97) 123456/2022', 'Tekući račun pravnog lica'
    ),
    [
        new \i3or1s\EFakture\UBL\TaxSubtotal(2801.15, 20),
        new \i3or1s\EFakture\UBL\TaxSubtotal(1825.28, 10),
        new \i3or1s\EFakture\UBL\TaxSubtotal(1560, 0, null, 'PDV-RS-11-1-4'),
    ],
    6186.43, 6186.43, 6929.19, 0, 0, 6929.19,
    [
        new \i3or1s\EFakture\UBL\InvoiceLine(5, $unitMeasures['MTR'], 560.23, 'test item 1', 20, 1),
        new \i3or1s\EFakture\UBL\InvoiceLine(4, $unitMeasures['KMT'], 456.32, 'test item 2', 10, 2),
        new \i3or1s\EFakture\UBL\InvoiceLine(1, $unitMeasures['H87'], 1560, 'test item 3', 0, 3),
    ]
);

$invoiceService = new \i3or1s\EFakture\Service\Invoice();
$sefResponse = $invoiceService->send($apiService, $invoice);
print_r($sefResponse);
```

[1]: https://github.com/i3or1s/EFakture
[2]: https://github.com/i3or1s/UBL
[3]: https://github.com/i3or1s/EFakture/tree/main/src/Model
[4]: https://github.com/i3or1s/EFakture/tree/main/src/Storage/StorageInterface.php
[5]: https://github.com/i3or1s/EFakture/tree/main/src/UBL