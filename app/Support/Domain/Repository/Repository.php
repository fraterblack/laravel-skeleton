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
     * Prefix the columns with the table name
     * @param string $tableName
     * @param array $columns
     * @return array
     */
    public function prefixNestedColumns($tableName, array $columns)
    {
        $processedColumns = [];

        foreach ($columns as $columnName) {
            $processedColumns[] = $this->prefixColumn($tableName, $columnName);
        }

        return $processedColumns;
    }

    /**
     * Prefix the column name
     * @param string $tableName
     * @param string $columnName
     * @return string
     */
    public function prefixColumn($tableName, $columnName)
    {
        if (! Str::contains($columnName, '.')) {
            return "{$tableName}.{$columnName}";
        }

        return $columnName;
    }

    /**
     * Returns the limit to results
     * @param integer|null $limit
     * @return integer
     */
    public function resolveResultLimit($limit = null)
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;

        return $limit;
    }
}