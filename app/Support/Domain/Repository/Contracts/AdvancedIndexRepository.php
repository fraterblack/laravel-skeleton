<?php

namespace Lpf\Support\Domain\Repository\Contracts;

use Illuminate\Http\Request;

interface AdvancedIndexRepository
{
    /**
     * Returns records, searching and ordering
     * @param Request $request
     * @param array $columns
     * @param array $orderBy
     * @param int $take
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index(Request $request, array $columns = [ '*' ], array $orderBy = [], $take = null);

    /**
     * @param Request $request
     * @param array $filters
     * @return mixed
     */
    public function applyFilterBeforeIndex(Request $request, array $filters);

    /**
     * @return array
     */
    public function getFieldsSearchable();

    /**
     * Returns the predefined order clauses. Gets the clauses in $orderingDefault attribute and in the orderBy param gets passed in url.
     * @param Request $request
     *
     * @return array
     */
    public function getPredefinedOrderClauses(Request $request);

    /**
     * @return array
     */
    public function getOrderingDefault();
}
