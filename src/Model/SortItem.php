<?php

namespace i3or1s\EFakture\Model;

final class SortItem
{
    public readonly eSortColumn $sortColumn;
    public readonly SortDirection $sortDirection;

    public function __construct(eSortColumn $sortColumn, SortDirection $sortDirection)
    {
        $this->sortColumn = $sortColumn;
        $this->sortDirection = $sortDirection;
    }
}
