<?php

namespace Lpf\Domains\Location\Contracts;

use Lpf\Support\Domain\Repository\Contracts\Repository;

interface CityRepository extends Repository
{
    public function dataForSelect($stateId = null, $compact = false);
}
