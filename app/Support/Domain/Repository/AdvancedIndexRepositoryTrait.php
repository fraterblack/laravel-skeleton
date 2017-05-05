<?php

namespace Lpf\Support\Domain\Repository;

use Illuminate\Http\Request;

trait AdvancedIndexRepositoryTrait
{
    /**
     * Returns records, searching and ordering
     * @param Request $request
     * @param array $columns
     * @param array $orderBy
     * @param int $take
     *
     * @return \Illuminate\Pagination\AbstractPaginator
     */
    public function index(Request $request, array $columns = [ '*' ], array $orderBy = [], $take = null)
    {
        $modelTable = $this->newQuery()->getModel()->getTable();

        $query = $this->newQuery()->select($this->prefixNestedColumns($modelTable, $columns));

        $query = $this->applyFilterStatement($request, $query);
        $query = $this->applySearchStatement($request, $query);
        $query = $this->applyOrderStatement($query, array_merge($orderBy, $this->getPredefinedOrderClauses($request)));

        $results = $this->doQuery($query, $this->resolveResultLimit($take), true);

        $this->addQueries($request, $results);

        return $results;
    }

    /**
     * @param Request $request
     * @param array $filters
     * @return mixed
     */
    public function applyFilterBeforeIndex(Request $request, array $filters)
    {
        $request->merge([
            config('repository.request.params.filter', 'filter') => $request->query(config('repository.request.params.filter', 'filter'), $filters)
        ]);
    }

    /**
     * @return array
     */
    public function getFieldsSearchable()
    {
        if (property_exists($this, 'fieldSearchable')) {
            if (is_array($this->fieldSearchable) && count($this->fieldSearchable) > 0) {
                return $this->fieldSearchable;
            }

            throw new \InvalidArgumentException('The value of $fieldSearchable argument is invalid.');
        } else {
            throw new \BadMethodCallException('The $fieldSearchable argument is missing in the repository.');
        }
    }

    /**
     * Returns the predefined order clauses. Gets the clauses in $orderingDefault attribute and in the orderBy param gets passed in url.
     * @param Request $request
     * @return array
     */
    public function getPredefinedOrderClauses(Request $request)
    {
        $orderClauses = [];

        $orderBy = $request->get(config('repository.request.params.orderBy', 'orderBy'), null);
        $sortedBy = $request->get(config('repository.request.params.sortedBy', 'sortedBy'), 'asc');

        if (!empty($orderBy) && !empty($sortedBy)) {
            $orderClauses[$orderBy] = $sortedBy;
        }

        if ($ordering = $this->getOrderingDefault()) {
            foreach ($ordering as $column => $sort) {
                if (!array_key_exists($column, $orderClauses)) {
                    $orderClauses[$column] = $sort;
                }
            }
        }

        return $orderClauses;
    }

    /**
     * @return array
     */
    public function getOrderingDefault()
    {
        if (property_exists($this, 'orderingDefault')) {
            if (!is_array($this->orderingDefault)) {
                throw new \InvalidArgumentException('The value of $orderingDefault argument is invalid.');
            }

            if (empty($this->orderingDefault)) {
                $this->orderingDefault = [
                    'id' => 'desc'
                ];
            }

            return $this->orderingDefault;
        } else {
            throw new \BadMethodCallException('The $orderingDefault argument is missing in the repository');
        }
    }

    /**
     * Adds queries if any param was get passed in url
     * @param string $request
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function addQueries($request, $model)
    {
        //dd($request);

        $model->addQuery(config('repository.request.params.search', 'search'), $request->get(config('repository.request.params.search')));
        $model->addQuery(config('repository.request.params.filter', 'filter'), $request->get(config('repository.request.params.filter')));
        $model->addQuery(config('repository.request.params.orderBy', 'orderBy'), $request->get(config('repository.request.params.orderBy')));
        $model->addQuery(config('repository.request.params.sortedBy', 'sortedBy'), $request->get(config('repository.request.params.sortedBy')));
    }


    /**
     * Applies the order statement in the query.
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     * @param array $orderClauses
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function applyOrderStatement($query, array $orderClauses = [])
    {
        if (!is_null($query)) {

            foreach ($orderClauses as $column => $sort) {
                $query->orderBy($column, $sort);
            }
        }

        return $query;
    }

    /**
     * Applies the filter statement in the query
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|null $query
     * @param array|null $filter
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function applyFilterStatement(Request $request, $query = null, array $filter = null)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        $filterTerms = ($filter) ? $filter : $request->get(config('repository.request.params.filter', 'filter'), null);

        if ($filterTerms) {
            $query = $this->createWhereClauseForFilter($filterTerms, $query);
        }

        return $query;
    }

    /**
     * Create the where clauses used in filter statement
     *
     * @param array|string $filterTerms
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|null $query
     */
    protected function createWhereClauseForFilter($filterTerms, $query = null)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        if (is_string($filterTerms)) {
            $filterTerms = [ $filterTerms ];
        }

        foreach ($this->parseFilterTerms($filterTerms) as $filterColumn) {
            $query->where(function ($query) use ($filterColumn) {
                $count = 1;
                foreach ($filterColumn as $whereAttributes) {
                    if ($count == 1) {
                        $query->where($whereAttributes['column'], $whereAttributes['condition'], $whereAttributes['value']);
                    } else {
                        $query->orWhere($whereAttributes['column'], $whereAttributes['condition'], $whereAttributes['value']);
                    }

                    $count++;
                }
            });
        }

        return $query;
    }

    /**
     * Applies the search statement in the query
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|null $query
     * @param string|null $search
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function applySearchStatement(Request $request, $query = null, $search = null)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        //try {
            $fieldsSearchable = $this->getFieldsSearchable();
        //} catch (\Exception $e) {
            //dd('Sai');
            //return new \Exception();
        //}

        $search = ($search) ? $search : $request->get(config('repository.request.params.search', 'search'), null);

        if ($search && is_array($fieldsSearchable) && count($fieldsSearchable)) {
            $fields = $fieldsSearchable;
            $isFirstField = true;
            $searchData = $this->parseSearchData($search);
            $search = $this->parseSearchValue($search);
            $modelForceAndWhere = false;

            $query->where(function ($query) use($fields, $search, $searchData, $isFirstField, $modelForceAndWhere) {
                foreach ($fields as $field=>$condition) {

                    if (is_numeric($field)){
                        $field = $condition;
                        $condition = "=";
                    }

                    $value = null;

                    $condition  = trim(strtolower($condition));

                    if ( isset($searchData[$field]) ) {
                        $value = $condition == "like" ? "%{$searchData[$field]}%" : $searchData[$field];
                    } else {
                        if ( !is_null($search) ) {
                            $value = $condition == "like" ? "%{$search}%" : $search;
                        }
                    }

                    if ( $isFirstField || $modelForceAndWhere ) {
                        if (!is_null($value)) {
                            $query->where($field,$condition,$value);
                            $isFirstField = false;
                        }
                    } else {
                        if (!is_null($value)) {
                            $query->orWhere($field,$condition,$value);
                        }
                    }
                }
            });
        }

        return $query;
    }

    /**
     * @param string $search
     *
     * @return mixed
     */
    protected function parseSearchData($search)
    {
        $searchData = [];

        if (stripos($search, ':')) {
            $fields = explode(';', $search);

            foreach ($fields as $row) {
                try {
                    list($field, $value) = explode(':', $row);
                    $searchData[$field] = $value;
                } catch (\Exception $e) {
                    //Surround offset error
                }
            }
        }

        return $searchData;
    }

    /**
     * @param string $search
     *
     * @return mixed
     */
    protected function parseSearchValue($search)
    {
        if (stripos($search, ';') || stripos($search, ':')) {
            $values = explode(';', $search);
            foreach ($values as $value) {
                $s = explode(':', $value);
                if ( count($s) == 1 ) {
                    return $s[0];
                }
            }
            return null;
        }

        return $search;
    }

    /**
     * @param array $filterTerm
     *
     * @return mixed
     */
    protected function parseFilterTerms(array $filterTerms)
    {
        $parsedTerms = [];

        foreach ($filterTerms as $filterTerm) {
            if (!empty($filterTerm)) {
                $parsedTerm = $this->parseFilterTerm($filterTerm);
                $parsedTerms[$parsedTerm['column']][] = $parsedTerm;
            }
        }

        return $parsedTerms;
    }

    /**
     * @param $filterTerm
     * @return array
     */
    protected function parseFilterTerm($filterTerm)
    {
        $parsedTerm = [];

        if (stripos($filterTerm, '.')) {
            $values = explode('.', $filterTerm);

            $parsedTerm = [
                'column' => $values[0],
                'condition' => $values[1],
                'value' => $values[2]
            ];
        }

        return $parsedTerm;
    }
}