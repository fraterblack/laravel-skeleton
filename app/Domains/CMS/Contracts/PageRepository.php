<?php

namespace Lpf\Domains\CMS\Contracts;

use Lpf\Support\Domain\Repository\Contracts\AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Contracts\Repository;

interface PageRepository extends Repository, AdvancedIndexRepository
{
    public function findBySlug($slug, $onlyActive = true, $columns = [ '*' ]);
}
