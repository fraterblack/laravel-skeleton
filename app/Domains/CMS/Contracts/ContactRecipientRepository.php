<?php

namespace Lpf\Domains\CMS\Contracts;

use Lpf\Support\Domain\Repository\Contracts\AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Contracts\Repository;
use Lpf\Support\Domain\Repository\Contracts\RetrieveExtendedRepository;

interface ContactRecipientRepository extends Repository, RetrieveExtendedRepository, AdvancedIndexRepository
{
    public function getActive($columns = ['*'], $take = false, $paginate = false);
}
