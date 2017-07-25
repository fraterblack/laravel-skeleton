<?php

namespace Lpf\Domains\CMS\Contracts;

use Lpf\Support\Domain\Repository\Contracts\AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Contracts\Repository;

interface BannerPlaceRepository extends Repository, AdvancedIndexRepository
{
    public function getAvailableTypes();

    public function dataForSelect();
}
