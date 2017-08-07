<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\Contracts\PageRepository as PageRepositoryContract;
use Lpf\Domains\CMS\Page;
use Lpf\Support\Domain\Repository\Traits\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;

class PageRepository extends Repository implements PageRepositoryContract
{
    use AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass = Page::class;

    protected $searchableFields = [
        'title' => 'like',
    ];

    protected $defaultSorting = [
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