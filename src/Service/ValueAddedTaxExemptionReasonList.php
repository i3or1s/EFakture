<?php

namespace i3or1s\EFakture\Service;

use i3or1s\EFakture\Model\ValueAddedTaxExemptionReasonDto;
use i3or1s\EFakture\ResourceStream\ResourceStreamInterface;
use i3or1s\EFakture\Util\EFakturaAPIRoutes;
use i3or1s\EFakture\Util\EFaktureApi;

final class ValueAddedTaxExemptionReasonList
{
    /**
     * @return ValueAddedTaxExemptionReasonDto[]
     */
    public function retrieve(EFaktureApi $api, ResourceStreamInterface $resourceStream, int $page = 0, int $offset = 10): array
    {
        /** @var ValueAddedTaxExemptionReasonDto[] $exemptionList */
        $exemptionList = [];
        try {
            $streamResponse = $api->streamResource(EFakturaAPIRoutes::VALUE_ADDED_TAX_EXEMPTION_LIST, $resourceStream);
            $index = $page * $offset;

            while ($index < ($page * $offset) + $offset) {
                if (null === $streamResponse[$index]) {
                    return $exemptionList;
                }
                /** @var ValueAddedTaxExemptionReasonDto|null $exemption */
                $exemption = $streamResponse[$index];
                if (null === $exemption) {
                    return $exemptionList;
                }
                $exemptionList[] = $exemption;
                ++$index;
            }
        } catch (\Throwable $e) {
            return [];
        }

        return $exemptionList;
    }
}
