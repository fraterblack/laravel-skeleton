<?php

namespace Lpf\Domains\Location\Contracts;

use Lpf\Support\Domain\Repository\Contracts\Repository;
use Lpf\Support\Domain\Repository\Contracts\RetrieveExtendedRepository;

interface CityRepository extends Repository, RetrieveExtendedRepository
{
    public function dataForSelect($stateId = null, $compact = false);
}
