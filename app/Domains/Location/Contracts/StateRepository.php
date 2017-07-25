<?php

namespace Lpf\Domains\Location\Contracts;

use Lpf\Support\Domain\Repository\Contracts\Repository;

interface StateRepository extends Repository
{
    public function dataForSelect($compact = true);
}
