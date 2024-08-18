<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * Paginate a collection of items.
 *
 * @param \Illuminate\Support\Collection $collection
 * @param int $perPage
 * @param int $currentPage
 * @param array $options
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
function paginateCollection($collection, $perPage = 15, $currentPage = 1, $options = [])
{
    // Slice the collection to get the items to display in current page
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();

    // Create a new LengthAwarePaginator instance
    return new LengthAwarePaginator(
        $currentPageItems,
        $collection->count(),
        $perPage,
        $currentPage,
        $options
    );
}