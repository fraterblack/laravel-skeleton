<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\BannerPlace;
use Lpf\Domains\CMS\Contracts\BannerPlaceRepository as BannerPlaceRepositoryContract;
use Lpf\Support\Domain\Repository\Traits\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;

class BannerPlaceRepository extends Repository implements BannerPlaceRepositoryContract
{
    use AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass = BannerPlace::class;

    protected $searchableFields = [
        'name' => 'like',
    ];

    protected $defaultSorting = [
        'name' => 'asc'
    ];

    public function getAvailableTypes()
    {
        return BannerPlace::$typeTexts;
    }

    public function dataForSelect()
    {
        $query = $this->newQuery();

        return $query->orderBy('name', 'asc')->get([ 'name', 'id' ])->pluck('name', 'id');
    }
}