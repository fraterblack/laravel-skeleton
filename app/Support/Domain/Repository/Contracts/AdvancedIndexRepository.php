<?php

namespace Lpf\Support\Domain\Repository\Contracts;

interface AdvancedIndexRepository
{
    /**
     * Returns records, searching and ordering
     * @param array $requestParam
     * @param array $columns
     * @param array $orderBy
     * @param int $take
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index(array $requestParam, array $columns = [ '*' ], array $orderBy = [], $take = null);

    /**
     * @return array
     */
    public function getFieldsSearchable();

    /**
     * Returns the predefined sorting clauses. Gets the clauses in $defaultSorting attribute and in the orderBy param gets passed in url.
     * @param array $requestParam
     *
     * @return array
     */
    public function getPredefinedSortingClauses(array $requestParam);

    /**
     * @return array
     */
    public function getDefaultSorting();
}
