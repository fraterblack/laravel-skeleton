<?php

namespace Lpf\Support\Domain\Repository\Contracts;

use Artesaos\Warehouse\Contracts\Operations\ReadRecords;

interface ExtendedReadRecordsRepository extends ReadRecords
{
    public function findBySlug($slug, $columns = [ '*' ]);

    public function findByCode($code, $columns = [ '*' ]);

    public function findByField($field, $value, $columns = [ '*' ]);
}