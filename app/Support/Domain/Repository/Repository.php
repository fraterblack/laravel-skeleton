<?php

namespace Lpf\Support\Domain\Repository;

use Artesaos\Warehouse\CrudRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Lpf\Support\Domain\Repository\Contracts\Repository as RepositoryContract;

class Repository extends CrudRepository implements RepositoryContract
{
    /**
     * Delete model by id
     *
     * @param int $id
     *
     * @return bool
     */
    public function deleteById($id)
    {
        $model = $this->findByID($id);

        return $this->delete($model);
    }

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