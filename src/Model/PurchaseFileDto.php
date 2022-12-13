<?php

namespace i3or1s\EFakture\Model;

final class PurchaseFileDto
{
    public readonly int $id;
    public readonly ?string $name;
    public readonly ?string $extension;
    public readonly int $invoiceId;
    public readonly bool $mainPdf;
    public readonly bool $mainXml;
    public readonly bool $isFitekInZip;
    public readonly bool $isLink;
    public readonly ?string $link;

    public function __construct(int $id, ?string $name, ?string $extension, int $invoiceId, bool $mainPdf, bool $mainXml, bool $isFitekInZip, bool $isLink, ?string $link)
    {
        $this->id = $id;
        $this->name = $name;
        $this->extension = $extension;
        $this->invoiceId = $invoiceId;
        $this->mainPdf = $mainPdf;
        $this->mainXml = $mainXml;
        $this->isFitekInZip = $isFitekInZip;
        $this->isLink = $isLink;
        $this->link = $link;
    }
}
