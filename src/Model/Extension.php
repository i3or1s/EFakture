<?php

namespace i3or1s\EFakture\Model;

final class Extension
{
    public readonly ?string $extensionId;
    public readonly ?string $informationName;
    public readonly ?string $informationContent;

    public function __construct(?string $extensionId, ?string $informationName, ?string $informationContent)
    {
        $this->extensionId = $extensionId;
        $this->informationName = $informationName;
        $this->informationContent = $informationContent;
    }
}
