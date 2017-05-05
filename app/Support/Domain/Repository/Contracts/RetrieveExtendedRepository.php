<?php

namespace Lpf\Support\Domain\Repository\Contracts;

interface RetrieveExtendedRepository
{
    public function findBySlug($slug, $columns = [ '*' ]);

    public function findByCode($code, $columns = [ '*' ]);

    public function findByField($field, $value, $columns = [ '*' ]);
}