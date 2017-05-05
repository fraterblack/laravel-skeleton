<?php

namespace Lpf\Support\Domain\Repository\Contracts;

interface SortableRepository
{
    public function reorder($position, $modelId, $targetModelId);
}