<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\CBC\ID;

final class Party
{
    public readonly \i3or1s\UBL\CAC\Party $party;

    public function __construct(
        string $PIB,
        ?string $JBKJS,
        string $name,
        ?string $address,
        string $city,
        string $countryCode,
        string $identificationNumber,
        ?string $emailAddress,
        bool $inVAT = true
    ) {
        $this->party = new \i3or1s\UBL\CAC\Party(
            null,
            null,
            null,
            null,
            new \i3or1s\UBL\CBC\EndpointID(
                new \i3or1s\UBL\Basic\NormalizedString($PIB),
                new \i3or1s\UBL\Basic\NormalizedString('9948'),
                null,
                null,
                null,
                null,
                null,
                null
            ),
            null,
            null !== $JBKJS ? [new \i3or1s\UBL\CAC\PartyIdentification(new ID(
                new \i3or1s\UBL\Basic\NormalizedString(sprintf('JBKJS:%s', $JBKJS)),
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ))] : null,
            [new \i3or1s\UBL\CAC\PartyName(
                new \i3or1s\UBL\CBC\Name($name, null, null)
            )],
            null,
            new \i3or1s\UBL\CAC\PostalAddress(
                null,
                null,
                null,
                null,
                null,
                null,
                null !== $address ? new \i3or1s\UBL\CBC\StreetName($address, null, null) : null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                new \i3or1s\UBL\CBC\CityName($city, null, null),
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                new \i3or1s\UBL\CAC\Country(
                    new \i3or1s\UBL\CBC\IdentificationCode(
                        new \i3or1s\UBL\Basic\NormalizedString($countryCode),
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                    ),
                    null
                ),
                null
            ),
            null,
            [new \i3or1s\UBL\CAC\PartyTaxScheme(
                null,
                new \i3or1s\UBL\CBC\CompanyID(
                    new \i3or1s\UBL\Basic\NormalizedString(sprintf('RS%s', $PIB)),
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                null,
                null,
                null,
                null,
                new \i3or1s\UBL\CAC\TaxScheme(
                    new ID(
                        new NormalizedString($inVAT ? 'VAT' : 'NO-VAT'),
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                    ),
                    null,
                    null,
                    null,
                    null
                )
            )],
            [new \i3or1s\UBL\CAC\PartyLegalEntity(
                new \i3or1s\UBL\CBC\RegistrationName($name, null, null),
                new \i3or1s\UBL\CBC\CompanyID(
                    new \i3or1s\UBL\Basic\NormalizedString($identificationNumber),
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            )],
            null !== $emailAddress ? new \i3or1s\UBL\CAC\Contact(
                null,
                null,
                null,
                null,
                new \i3or1s\UBL\CBC\ElectronicMail($emailAddress, null, null),
                null,
                null
            ) : null,
            null,
            null,
            null,
            null,
            null
        );
    }
}
