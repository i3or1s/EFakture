<?php

namespace Boris\EFakture\Model;

use Boris\EFakture\Util\IsStringLength;
use http\Exception\RuntimeException;

final class SspAddressDto
{
    public readonly int $addressId;
    public readonly ?string $streetAndHouse; // min:0, max: 100
    public readonly ?string $postalIndex; // min:0, max: 20
    public readonly ?string $city; // min:0, max:100
    public readonly ?int $countryId;

    public function __construct(int $addressId, ?string $streetAndHouse, ?string $postalIndex, ?string $city, ?int $countryId)
    {
        $this->addressId = $addressId;

        if (IsStringLength::validate($streetAndHouse, 0, 100)) {
            throw new RuntimeException('invalid.length.street_and_house');
        }
        $this->streetAndHouse = $streetAndHouse;

        if (IsStringLength::validate($postalIndex, 0, 20)) {
            throw new RuntimeException('invalid.length.postal_index');
        }
        $this->postalIndex = $postalIndex;

        if (IsStringLength::validate($city, 0, 100)) {
            throw new RuntimeException('invalid.length.city');
        }
        $this->city = $city;

        $this->countryId = $countryId;
    }
}
