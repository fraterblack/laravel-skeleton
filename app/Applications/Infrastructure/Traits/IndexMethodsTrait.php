<?php

namespace Lpf\Applications\Infrastructure\Traits;

trait IndexMethodsTrait
{
    protected $indexFilters;

    protected function createIndexFilter($title, $column, $condition, $multiple, array $options, $remoteSearch = null)
    {
        $this->indexFilters[] = [
            'title' => $title,
            'column' => $column,
            'condition' => $condition,
            'multiple' => $multiple,
            'options' => $options,
            'remote_search' => $remoteSearch
        ];
    }

    protected function getIndexFilters()
    {
        return $this->indexFilters;
    }
}