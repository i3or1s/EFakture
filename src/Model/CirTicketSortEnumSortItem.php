<?php

namespace Boris\EFakture\Model;

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
