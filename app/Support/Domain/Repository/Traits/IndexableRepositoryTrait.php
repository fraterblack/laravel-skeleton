<?php

namespace Lpf\Support\Domain\Repository\Traits;

trait IndexableRepositoryTrait
{
    /**
     * Get indexable models
     *
     * @return bool
     */
    public function getIndexable()
    {
        $query = $this->newQuery();
        $query->select($this->getIndexableColumns());

        return $this->doQuery($query, false, false);
    }

    /**
     * @return array
     *
     * @trows \Exception
     */
    protected function getIndexableColumns()
    {
        if (property_exists($this, 'indexableColumns')) {
            if (is_array($this->indexableColumns) && count($this->indexableColumns) > 0) {
                return $this->indexableColumns;
            }

            throw new \InvalidArgumentException('The value of self::indexableColumns argument is invalid.');
        }

        throw new \BadMethodCallException('The self::indexableColumns argument is missing in the repository.');
    }
}