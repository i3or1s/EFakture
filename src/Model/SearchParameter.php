<?php

namespace i3or1s\EFakture\Model;

final class SearchParameter
{
    public readonly ?SortItem $sortItems;
    public readonly PagingOptions $pagingOptions;
    public readonly ?RestrictionItem $restrictions;

    public function __construct(?SortItem $sortItems, PagingOptions $pagingOptions, ?RestrictionItem $restrictions)
    {
        $this->sortItems = $sortItems;
        $this->pagingOptions = $pagingOptions;
        $this->restrictions = $restrictions;
    }
}
