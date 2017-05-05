<?php

namespace Lpf\Support\Domain\Repository;

trait SortableRepositoryTrait
{
    /**
     * Reorder models
     *
     * @param string  $position
     * @param int  $modelId
     * @param int $targetModelId
     *
     * @return bool
     */
    public function reorder($position, $modelId, $targetModelId)
    {
        $model = $this->findByID($modelId);
        $targetModel = $this->findByID($targetModelId);

        switch ($position) {
            case 'moveBefore':
                $model->moveBefore($targetModel);
                break;
            case 'moveAfter':
                $model->moveAfter($targetModel);
                break;
        }

        return true;
    }
}