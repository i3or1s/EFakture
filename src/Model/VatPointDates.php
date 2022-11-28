<?php

namespace Boris\EFakture\Model;

enum VatPointDates: string
{
    case NONE = 'None';
    case ISSUING_DATE = 'IssuingDate';
    case DELIVERY_DATE = 'DeliveryDate';
    case PAYMENT_DATE = 'PaymentDate';
}
