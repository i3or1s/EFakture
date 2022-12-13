<?php

namespace i3or1s\EFakture\Model;

final class PagingOptions
{
    public readonly int $pageIndex;
    public readonly int $pageSize;

    public function __construct(int $pageIndex, int $pageSize)
    {
        $this->pageIndex = $pageIndex;
        $this->pageSize = $pageSize;
    }
}
