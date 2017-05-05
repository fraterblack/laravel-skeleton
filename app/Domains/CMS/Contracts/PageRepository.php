<?php

namespace Lpf\Domains\CMS\Contracts;

use Lpf\Support\Domain\Repository\Contracts\AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Contracts\Repository;
use Lpf\Support\Domain\Repository\Contracts\RetrieveExtendedRepository;

interface PageRepository extends Repository, RetrieveExtendedRepository, AdvancedIndexRepository
{
    public function findBySlug($slug, $onlyActive = true, $columns = [ '*' ]);
}
