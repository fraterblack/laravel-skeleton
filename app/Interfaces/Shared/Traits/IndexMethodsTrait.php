<?php

namespace Lpf\Interfaces\Shared\Traits;

trait IndexMethodsTrait
{

    /**
     * @var array
     */
    protected $indexFilters;

    /**
     * Seta as configurações do filtro a ser criado na página que lista os cadastros
     * @param string $title
     * @param string $column
     * @param string $condition
     * @param string $type
     * @param array $options
     */
    protected function addIndexFilter($title, $column, $condition, $type = 'select', array $options = [])
    {
        $this->indexFilters[] = [
            'title' => $title,
            'column' => $column,
            'condition' => $condition,
            'type' => $type,
            'options' => $options
        ];
    }

    /**
     * @return null|array
     */
    protected function getIndexFilters()
    {
        return $this->indexFilters;
    }
}