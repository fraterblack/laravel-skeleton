<?php

namespace Lpf\Support\Domain\Repository\Contracts;

use Artesaos\Warehouse\Contracts\Operations\CreateRecords;
use Artesaos\Warehouse\Contracts\Operations\UpdateRecords;
use Artesaos\Warehouse\Contracts\Repository as WarehouseRepositoryContract;

interface Repository extends
    WarehouseRepositoryContract,
    CreateRecords,
    UpdateRecords,
    ExtendedReadRecordsRepository,
    ExtendedDeleteRecordsRepository
{
    /**
     * Load relations of a Model
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Contracts\Pagination\Paginator $model
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function loadModelRelations($model, array $relations);

    /**
     * Prefix the columns with the table name
     * @param string $tableName
     * @param array $columns
     * @return array
     */
    public function prefixNestedColumns($tableName, array $columns);

    /**
     * Prefix the column name
     * @param string $tableName
     * @param string $columnName
     * @return string
     */
    public function prefixColumn($tableName, $columnName);

    /**
     * Returns the limit to results
     * @param integer|null $limit
     * @return integer
     */
    public function resolveResultLimit($limit = null);
}