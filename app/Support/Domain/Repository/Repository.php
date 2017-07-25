<?php

namespace Lpf\Support\Domain\Repository;

use InvalidArgumentException;
use Illuminate\Support\Str;
use Artesaos\Warehouse\Operations\CreateRecords;
use Artesaos\Warehouse\Operations\UpdateRecords;
use Lpf\Support\Domain\Repository\Traits\ExtendedDeleteRecordsTrait;
use Lpf\Support\Domain\Repository\Traits\ExtendedReadRecordsTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Lpf\Support\Domain\Repository\Contracts\Repository as RepositoryContract;
use Artesaos\Warehouse\Repository as WarehouseRepository;

abstract class Repository extends WarehouseRepository implements RepositoryContract
{
    use CreateRecords,
        ExtendedReadRecordsTrait,
        UpdateRecords,
        ExtendedDeleteRecordsTrait;

    /**
     * Load relations of a Model
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Contracts\Pagination\Paginator $model
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function loadModelRelations($model, array $relations)
    {
        if ($model instanceof LengthAwarePaginator && $model instanceof $this->modelClass) {
            throw new InvalidArgumentException('The type of model instance is invalid');
        }

        $model->load($relations);

        return $model;
    }

    /**
     * Prefix the columns with the $table param
     * @param string $table
     * @param array $columns
     * @return array
     */
    public function prefixNestedColumns($table, array $columns)
    {
        $processedColumns = [];

        foreach ($columns as $column) {
            if (!Str::contains($column, '.')) {
                $processedColumns[] = $table . '.' . $column;
            }
        }

        return $processedColumns;
    }

    /**
     * Returns the limit to results
     *
     * @return int
     */
    public function resolveResultLimit($limit = null)
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;

        return $limit;
    }
}