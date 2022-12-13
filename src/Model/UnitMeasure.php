<?php

namespace i3or1s\EFakture\Model;

final class UnitMeasure implements SEFStorageInterface
{
    public readonly string $code;
    public readonly ?string $symbol;
    public readonly string $nameEng;
    public readonly string $nameSrbLtn;
    public readonly string $nameSrbCyr;
    public readonly bool   $isOnShortList;

    public function __construct(string $code, ?string $symbol, string $nameEng, string $nameSrbLtn, string $nameSrbCyr, bool $isOnShortList)
    {
        $this->code = $code;
        $this->symbol = $symbol;
        $this->nameEng = $nameEng;
        $this->nameSrbLtn = $nameSrbLtn;
        $this->nameSrbCyr = $nameSrbCyr;
        $this->isOnShortList = $isOnShortList;
    }

    /**
     * @return array{code: string,symbol: ?string,nameEng: string,nameSrbLtn: string,nameSrbCyr: string,isOnShortList: bool}
     */
    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'symbol' => $this->symbol,
            'nameEng' => $this->nameEng,
            'nameSrbLtn' => $this->nameSrbLtn,
            'nameSrbCyr' => $this->nameSrbCyr,
            'isOnShortList' => $this->isOnShortList,
        ];
    }
}
