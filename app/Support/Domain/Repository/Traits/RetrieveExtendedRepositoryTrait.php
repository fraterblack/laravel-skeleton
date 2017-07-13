<?php

namespace Lpf\Support\Domain\Repository\Traits;

trait RetrieveExtendedRepositoryTrait
{
    /**
     * Retrieves a record by his id
     *
     * @param int  $id
     * @param array  $columns
     * @param bool $fail
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByID($id, $columns = [ '*' ], $fail = true)
    {
        if ($fail) {
            return $this->newQuery()->select($this->prefixNestedColumns($this->getModelTable(), $columns))->findOrFail($id);
        }

        return $this->newQuery()->select($this->prefixNestedColumns($this->getModelTable(), $columns))->find($id);
    }

    /**
     * Overwrite method in Artesaos\Warehouse\BaseRepository
     * Returns all records.
     * If $take is false then brings all records
     * If $paginate is true returns Paginator instance.
     *
     * @param int  $take
     * @param bool $paginate
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Pagination\Paginator
     */
    public function getAll($columns = [ '*' ], $take = 15, $paginate = true)
    {
        $query = $this->newQuery();
        $query->select($this->prefixNestedColumns($this->getModelTable(), $columns));

        return $this->doQuery($query, $take, $paginate);
    }

    /**
     * Retrieves a record by his specified field
     *
     * @param string  $field
     * @param string  $value
     * @param array  $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByField($field, $value, $columns = [ '*' ])
    {
        return $this->newQuery()->select($this->prefixNestedColumns($this->getModelTable(), $columns))->where($field, $value)->get();
    }

    /**
     * Find a model by slug column
     *
     * @param string $slug
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBySlug($slug, $columns = [ '*' ])
    {
        $query = $this->newQuery();

        $query->getModel()->setKeyName('slug');

        return $query
            ->select($this->prefixNestedColumns($this->getModelTable(), $columns))
            ->findOrFail($slug);
    }

    /**
     * Find a model by code column
     *
     * @param string $slug
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByCode($code, $columns = [ '*' ])
    {
        $query = $this->newQuery();

        $query->getModel()->setKeyName('code');

        return $query
            ->select($this->prefixNestedColumns($this->getModelTable(), $columns))
            ->findOrFail($code);
    }

    /**
     * @param string      $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        return $this->pluck($column, $key);
    }

    /**
     * @param string      $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function pluck($column, $key = null)
    {
        return $this->newQuery()->pluck($column, $key);
    }

    protected function getModelTable()
    {
        return $this->newQuery()->getModel()->getTable();
    }
}