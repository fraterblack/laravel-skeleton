<?php

namespace Lpf\Domains\Location\Repositories;

use Lpf\Domains\Location\Contracts\StateRepository as StateRepositoryContract;
use Lpf\Domains\Location\State;
use Lpf\Support\Domain\Repository\Repository;
use Lpf\Support\Domain\Repository\Traits\RetrieveExtendedRepositoryTrait as RetrieveExtendedRepository;

class StateRepository extends Repository implements StateRepositoryContract
{
    use RetrieveExtendedRepository;

    /**
     * Model class for repo.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelClass = State::class;

    public function dataForSelect($compact = true)
    {
        $query = $this->newQuery();

        if ($compact) {
            $query->select([ 'abbreviation', 'id' ])->orderBy('abbreviation', 'asc');

            return $this->doQuery($query, null, false)->pluck('abbreviation', 'id');
        } else {
            $query->orderBy('abbreviation', 'asc');

            return $this->doQuery($query, null, false);
        }
    }
}