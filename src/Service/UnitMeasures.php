<?php

namespace i3or1s\EFakture\Service;

use i3or1s\EFakture\Model\UnitMeasure;
use i3or1s\EFakture\Util\EFakturaAPIRoutes;
use i3or1s\EFakture\Util\EFaktureApi;

final class UnitMeasures
{
    /**
     * @return UnitMeasure[]
     */
    public function retrieve(EFaktureApi $api): array
    {
        /** @var UnitMeasure[] $unitMeasures */
        $unitMeasures = [];
        try {
            /** @var array<array{Code: string, Symbol: string|null, NameEng: string, NameSrbLtn: string, NameSrbCyr: string, IsOnShortList: bool}> $systemUnitMeasures */
            $systemUnitMeasures = $api->getResource(EFakturaAPIRoutes::GET_UNIT_MEASURES);
        } catch (\Throwable $e) {
            return [];
        }
        foreach ($systemUnitMeasures as $unitMeasure) {
            $unitMeasures[$unitMeasure['Code']] = new UnitMeasure(
                $unitMeasure['Code'],
                $unitMeasure['Symbol'],
                $unitMeasure['NameEng'],
                $unitMeasure['NameSrbLtn'],
                $unitMeasure['NameSrbCyr'],
                $unitMeasure['IsOnShortList']
            );
        }

        return $unitMeasures;
    }
}
