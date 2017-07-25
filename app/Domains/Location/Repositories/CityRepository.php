<?php

namespace Lpf\Domains\Location\Repositories;

use Lpf\Domains\Location\City;
use Lpf\Domains\Location\Contracts\CityRepository as CityRepositoryContract;
use Lpf\Support\Domain\Repository\Repository;

class CityRepository extends Repository implements CityRepositoryContract
{
    /**
     * Model class for repo.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelClass = City::class;

    public function dataForSelect($filterByState = null, $compact = false)
    {
        $query = $this->newQuery();

        if ($filterByState) {
            $query->where('state_id', (int) $filterByState);
        }

        if ($compact) {
            $query->select([ 'name', 'id', 'state_id' ])->orderBy('name', 'asc');

            return $this->doQuery($query, null, false)->pluck('name', 'id');
        } else {
            $query->orderBy('name', 'asc');

            return $this->doQuery($query, null, false);
        }
    }
}