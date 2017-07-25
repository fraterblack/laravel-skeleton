<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\Banner;
use Lpf\Domains\CMS\Contracts\BannerRepository as BannerRepositoryContract;
use Lpf\Support\Domain\Repository\Traits\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;

class BannerRepository extends Repository implements BannerRepositoryContract
{
    use AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass = Banner::class;

    protected $fieldSearchable = [
        'name' => 'like',
    ];

    protected $orderingDefault = [
        'created_at' => 'desc'
    ];
}