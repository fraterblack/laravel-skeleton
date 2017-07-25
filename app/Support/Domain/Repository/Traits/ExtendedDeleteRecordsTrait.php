<?php

namespace Lpf\Support\Domain\Repository\Traits;

use Artesaos\Warehouse\Operations\DeleteRecords;

trait ExtendedDeleteRecordsTrait
{
    use DeleteRecords;

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
}