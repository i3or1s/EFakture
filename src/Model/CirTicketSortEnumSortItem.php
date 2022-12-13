<?php

namespace i3or1s\EFakture\Model;

class CirTicketSortEnumSortItem
{
    public readonly CirTicketSortEnum $sortColumn;
    public readonly SortDirection $sortDirection;

    public function __construct(CirTicketSortEnum $sortColumn, SortDirection $sortDirection)
    {
        $this->sortColumn = $sortColumn;
        $this->sortDirection = $sortDirection;
    }
}
