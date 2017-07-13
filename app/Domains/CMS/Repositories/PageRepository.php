<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\Contracts\PageRepository as PageRepositoryContract;
use Lpf\Domains\CMS\Page;
use Lpf\Support\Domain\Repository\Traits\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;
use Lpf\Support\Domain\Repository\Traits\RetrieveExtendedRepositoryTrait as RetrieveExtendedRepository;

class PageRepository extends Repository implements PageRepositoryContract
{
    use RetrieveExtendedRepository, AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass = Page::class;

    protected $fieldSearchable = [
        'title' => 'like',
    ];

    protected $orderingDefault = [
        'title' => 'asc'
    ];

    public function findBySlug($slug, $onlyActive = true, $columns = [ '*' ])
    {
        $query = $this->newQuery()->select($columns);

        $query->getModel()->setKeyName('slug');

        if ($onlyActive) {
            $query->where('active', true);
        }

        return $query->findOrFail($slug);
    }
}