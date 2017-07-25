<?php

namespace Lpf\Support\Domain\Repository\Contracts;

use Artesaos\Warehouse\Contracts\Operations\DeleteRecords;

interface ExtendedDeleteRecordsRepository extends DeleteRecords
{
    /**
     * Delete entry by id
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}