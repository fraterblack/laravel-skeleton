<?php

namespace Lpf\Domains\CMS\Contracts;

use Lpf\Support\Domain\Repository\Contracts\AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Contracts\Repository;

interface ContactRecipientRepository extends Repository, AdvancedIndexRepository
{
    public function getActive($columns = ['*'], $take = false, $paginate = false);
}
