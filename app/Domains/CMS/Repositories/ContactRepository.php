<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\Contact;
use Lpf\Domains\CMS\Contracts\ContactRepository as ContactRepositoryContract;
use Lpf\Support\Domain\Repository\Traits\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;

class ContactRepository extends Repository implements ContactRepositoryContract
{
    use AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass = Contact::class;

    protected $searchableFields = [
        'name' => 'like',
        'subject' => 'like',
    ];

    protected $defaultSorting = [
        'created_at' => 'desc'
    ];
}