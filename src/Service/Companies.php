<?php

namespace i3or1s\EFakture\Service;

use i3or1s\EFakture\Exception\ResourceUnavailable;
use i3or1s\EFakture\Model\Company;
use i3or1s\EFakture\ResourceStream\ResourceStreamInterface;
use i3or1s\EFakture\Util\EFakturaAPIRoutes;
use i3or1s\EFakture\Util\EFaktureApi;

final class Companies
{
    /**
     * @return Company[]
     */
    public function retrieve(EFaktureApi $api, ResourceStreamInterface $resourceStream, int $page = 0, int $offset = 10): array
    {
        /** @var Company[] $companies */
        $companies = [];
        try {
            $streamResponse = $api->streamResource(EFakturaAPIRoutes::GET_ALL_COMPANIES, $resourceStream);
            $index = $page * $offset;
            while ($index < ($page * $offset) + $offset) {
                /** @var Company|null $company */
                $company = $streamResponse[$index];
                if (null === $company) {
                    return $companies;
                }
                $companies[] = $company;
                ++$index;
            }
        } catch (\Throwable $e) {
            return [];
        }

        return $companies;
    }

    /**
     * Whether a company can receive e-invoices on SEF. Pass at least one identifier: PIB
     * (VatNumber), MB (RegistrationNumber) or, for budget users, JBKJS.
     *
     * @throws ResourceUnavailable
     */
    public function isRegistered(EFaktureApi $api, ?string $vatNumber = null, ?string $registrationNumber = null, ?string $jbkjs = null): bool
    {
        $identifiers = array_filter([
            'vatNumber' => $vatNumber,
            'registrationNumber' => $registrationNumber,
            'jbkjs' => $jbkjs,
        ], static fn (?string $value): bool => null !== $value && '' !== $value);
        if ([] === $identifiers) {
            throw new \InvalidArgumentException('Pass a PIB, MB or JBKJS.');
        }

        return true === ($api->sendJson(EFakturaAPIRoutes::COMPANY_REGISTERED, $identifiers)['EFakturaRegisteredCompany'] ?? false);
    }

    /**
     * Streams the whole SEF registry (every company and budget user, about 225k rows) and
     * hands each one to $onCompany as it arrives.
     *
     * @param callable(Company): void $onCompany
     *
     * @return int the number of companies handed over
     *
     * @throws ResourceUnavailable
     */
    public function each(EFaktureApi $api, callable $onCompany): int
    {
        $text = static fn (mixed $value): ?string => is_scalar($value) && '' !== (string) $value ? (string) $value : null;

        return $api->streamJsonObjects(EFakturaAPIRoutes::GET_ALL_COMPANIES, static function (array $row) use ($onCompany, $text): void {
            $onCompany(new Company(
                $text($row['BugetCompanyNumber'] ?? $row['BudgetCompanyNumber'] ?? null),
                $text($row['RegistrationCode'] ?? null),
                $text($row['VatRegistrationCode'] ?? null),
                (string) ($row['Name'] ?? ''),
                $text($row['RegistrationDate'] ?? null),
                $text($row['DeletionDate'] ?? null),
            ));
        });
    }
}
