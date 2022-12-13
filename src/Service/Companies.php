<?php

namespace i3or1s\EFakture\Service;

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
}
