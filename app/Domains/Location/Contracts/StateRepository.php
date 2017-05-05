<?php

namespace Lpf\Domains\Location\Contracts;

use Lpf\Support\Domain\Repository\Contracts\Repository;
use Lpf\Support\Domain\Repository\Contracts\RetrieveExtendedRepository;

interface StateRepository extends Repository, RetrieveExtendedRepository
{
    public function dataForSelect($compact = true);
}
