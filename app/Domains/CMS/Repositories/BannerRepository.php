<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\Banner;
use Lpf\Domains\CMS\Contracts\BannerRepository as BannerRepositoryContract;
use Lpf\Support\Domain\Repository\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;
use Lpf\Support\Domain\Repository\RetrieveExtendedRepositoryTrait as RetrieveExtendedRepository;

class BannerRepository extends Repository implements BannerRepositoryContract
{
    use RetrieveExtendedRepository, AdvancedIndexRepository;

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