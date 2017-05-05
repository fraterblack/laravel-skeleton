<?php

namespace Lpf\Domains\CMS\Repositories;

use Lpf\Domains\CMS\ContactRecipient;
use Lpf\Domains\CMS\Contracts\ContactRecipientRepository as ContactRecipientRepositoryContract;
use Lpf\Support\Domain\Repository\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;
use Lpf\Support\Domain\Repository\RetrieveExtendedRepositoryTrait as RetrieveExtendedRepository;

class ContactRecipientRepository extends Repository implements ContactRecipientRepositoryContract
{
    use RetrieveExtendedRepository, AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass = ContactRecipient::class;

    protected $fieldSearchable = [
        'name' => 'like',
    ];

    protected $orderingDefault = [
        'name' => 'asc'
    ];

    public function getActive($columns = ['*'], $take = false, $paginate = false)
    {
        $query = $this->newQuery();
        $query->select($columns);
        $query->where('active', '1');
        $query->orderBy('name', 'asc');

        return $this->doQuery($query, $take, $paginate);
    }
}