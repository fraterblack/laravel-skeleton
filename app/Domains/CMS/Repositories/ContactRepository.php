<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\Contact;
use Lpf\Domains\CMS\Contracts\ContactRepository as ContactRepositoryContract;
use Lpf\Support\Domain\Repository\Traits\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;
use Lpf\Support\Domain\Repository\Traits\RetrieveExtendedRepositoryTrait as RetrieveExtendedRepository;

class ContactRepository extends Repository implements ContactRepositoryContract
{
    use RetrieveExtendedRepository, AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass = Contact::class;

    protected $fieldSearchable = [
        'name' => 'like',
        'subject' => 'like',
    ];

    protected $orderingDefault = [
        'created_at' => 'desc'
    ];
}