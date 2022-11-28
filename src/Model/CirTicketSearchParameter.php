<?php

namespace Boris\EFakture\Model;

final class CirTicketSearchParameter
{
    public readonly ?CirTicketSortEnumSortItem $sortItems;
    public readonly PagingOptions $pagingOptions;
    public readonly ?CirTicketSearchEnumRestrictionItem $restrictions;

    public function __construct(?CirTicketSortEnumSortItem $sortItems, PagingOptions $pagingOptions, ?CirTicketSearchEnumRestrictionItem $restrictions)
    {
        $this->sortItems = $sortItems;
        $this->pagingOptions = $pagingOptions;
        $this->restrictions = $restrictions;
    }
}
