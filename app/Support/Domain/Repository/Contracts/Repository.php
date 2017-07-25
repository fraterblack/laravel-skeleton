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
     * Prefix with table name nested columns
     * @param $table
     * @param array $columns
     * @return mixed
     */
    public function prefixNestedColumns($table, array $columns);

    /**
     * Return the result limit for a pagination
     * @param null $limit
     * @return mixed
     */
    public function resolveResultLimit($limit = null);
}