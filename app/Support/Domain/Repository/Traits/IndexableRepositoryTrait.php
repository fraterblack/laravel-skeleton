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
        $query->select(['*']);

        return $this->doQuery($query, false, false);
    }
}