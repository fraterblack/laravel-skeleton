<?php

namespace Lpf\Support\Domain\Repository\Traits;

trait AdvancedIndexRepositoryTrait
{
    /**
     * Returns records, searching and ordering
     * @param array $requestParam
     * @param array $columns
     * @param array $orderBy
     * @param int $take
     *
     * @return \Illuminate\Pagination\AbstractPaginator
     */
    public function index(array $requestParam, array $columns = ['*'], array $orderBy = [], $take = null)
    {
        $modelTable = $this->newQuery()->getModel()->getTable();

        $query = $this->newQuery()->select($this->prefixNestedColumns($modelTable, $columns));

        $this->applyFilterStatement($requestParam, $query);
        $this->applySearchStatement($requestParam, $query);
        $this->applySortStatement($query, array_merge($orderBy, $this->getPredefinedSortClauses($requestParam)));
        $this->applyAdditionalStatementToIndex($query);

        $results = $this->doQuery($query, $this->resolveResultLimit($take), true);

        $this->addQueries($requestParam, $results);

        return $results;
    }

    /**
     * @return arraypublic function index(array $requestParam, array $columns = ['*'], array $orderBy = [], $take = null)
    {
    $query = $this->newQuery();

    $query->select($this->prefixNestedColumns($query->getModel()->getTable(), $columns));

    $this->applyFilterStatement($requestParam, $query);
    $this->applySearchStatement($requestParam, $query);
    $this->applySortStatement($query, array_merge($orderBy, $this->getPredefinedSortClauses($requestParam)));
    $this->applyAdditionalStatementToIndex($query);

    $results = $this->doQuery($query, $this->resolveResultLimit($take), true);

    $this->addQueries($requestParam, $results);

    dd($query->toSql());

    return $results;
    }public function index(array $requestParam, array $columns = ['*'], array $orderBy = [], $take = null)
    {
    $query = $this->newQuery();

    $query->addSelect($this->prefixNestedColumns($query->getModel()->getTable(), $columns));

    $this->applyFilterStatement($requestParam, $query);
    $this->applySearchStatement($requestParam, $query);
    $this->applySortStatement($query, array_merge($orderBy, $this->getPredefinedSortClauses($requestParam)));
    $this->applyAdditionalStatementToIndex($query);

    $results = $this->doQuery($query, $this->resolveResultLimit($take), true);

    $this->addQueries($requestParam, $results);

    return $results;
    }
     */
    public function getFieldsSearchable()
    {
        if (property_exists($this, 'searchableFields')) {
            if (is_array($this->searchableFields) && count($this->searchableFields) > 0) {
                return $this->searchableFields;
            }

            throw new \InvalidArgumentException('The value of self::searchableFields argument is invalid.');
        } else {
            throw new \BadMethodCallException('The self::searchableFields argument is missing in the repository.');
        }
    }

    /**
     * Returns the predefined order clauses. Gets the clauses in $orderingDefault attribute and in the orderBy param gets passed in url.
     * @param array $requestParam
     * @return array
     */
    public function getPredefinedSortClauses(array $requestParam)
    {
        $orderClauses = [];

        $orderBy = $this->validRequestParam($requestParam, config('repository.request.params.orderBy', 'orderBy'));
        $sortedBy = $this->validRequestParam($requestParam, config('repository.request.params.sortedBy', 'sortedBy'), 'asc');

        if (!empty($orderBy) && !empty($sortedBy)) {
            $orderClauses[$orderBy] = $sortedBy;
        }

        if ($ordering = $this->getSalesingDefault()) {
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
    public function getSalesingDefault()
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
     * @param array $requestParam
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function addQueries(array $requestParam, $model)
    {
        $model->addQuery(config('repository.request.params.search', 'search'), $this->validRequestParam($requestParam, config('repository.request.params.search')));
        $model->addQuery(config('repository.request.params.filter', 'filter'), $this->validRequestParam($requestParam, config('repository.request.params.filter')));
        $model->addQuery(config('repository.request.params.orderBy', 'orderBy'), $this->validRequestParam($requestParam, config('repository.request.params.orderBy')));
        $model->addQuery(config('repository.request.params.sortedBy', 'sortedBy'), $this->validRequestParam($requestParam, config('repository.request.params.sortedBy')));
    }


    /**
     * Applies the order statement in the query.
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     * @param array $orderClauses
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function applySortStatement($query, array $orderClauses = [])
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
     * @param array $requestParam
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|null $query
     * @param array|null $filter
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function applyFilterStatement(array $requestParam, $query = null, array $filter = null)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        $filterTerms = ($filter) ? $filter : $this->validRequestParam($requestParam, config('repository.request.params.filter', 'filter'), null);

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
     * @return null
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
     * @param array $requestParam
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|null $query
     * @param string|null $search
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function applySearchStatement(array $requestParam, $query = null, $search = null)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        $fieldsSearchable = $this->getFieldsSearchable();

        $search = ($search) ? $search : $this->validRequestParam($requestParam, config('repository.request.params.search', 'search'));

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
     * Applies the a additional condition statement in the query.
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function applyAdditionalStatementToIndex($query)
    {
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
     * @param array $filterTerms
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

    /**
     * @param array $requestParam
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    protected function validRequestParam(array $requestParam, $key, $default = null)
    {
        if (isset($requestParam[$key])) {
            return $requestParam[$key];
        }

        return $default;
    }
}