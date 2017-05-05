<?php

namespace Lpf\Domains\Users\Repositories;

use Artesaos\Defender\Contracts\Defender;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\DatabaseManager;
use Lpf\Domains\Users\Contracts\UserRepository as UserRepositoryContract;
use Lpf\Domains\Users\User;
use Lpf\Support\Domain\Repository\AdvancedIndexRepositoryTrait as AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Repository;
use Lpf\Support\Domain\Repository\RetrieveExtendedRepositoryTrait as RetrieveExtendedRepository;

class UserRepository extends Repository implements UserRepositoryContract
{
    use RetrieveExtendedRepository, AdvancedIndexRepository;

    /**
     * Model class for repo.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelClass = User::class;

    protected $fieldSearchable = [
        'name' => 'like',
        'email' => 'like',
    ];

    protected $orderingDefault = [
        'created_at' => 'desc'
    ];

    protected $defender;
    protected $db;

    public function __construct(Application $app)
    {
        $this->defender = $app->make(Defender::class);
        $this->db = $app->make(DatabaseManager::class);
    }

    public function softDelete(User $user)
    {
        //Modifica as credenciais de acesso antes do SoftDelete
        $user->name = date("Ymd_His") . "_" . $user->name;
        $user->email = date("Ymd_His") . "_" . $user->email;
        $user->save();

        if ($this->delete($user)) {
            return true;
        }
    }

    public function search($keyWord, array $columns = ['*'])
    {
        $query = $this->newQuery();

        $query->select($columns);
        $query->orWhere('name', 'like', '%' . $keyWord . '%');

        return $query->get();
    }

    public function attachRole(User $user, $role)
    {
        $user->attachRole($role);
    }

    public function detachRole(User $user, $role)
    {
        return $user->detachRole($role);
    }
}