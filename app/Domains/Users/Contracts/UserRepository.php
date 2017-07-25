<?php

namespace Lpf\Domains\Users\Contracts;

use Lpf\Domains\Users\User;
use Lpf\Support\Domain\Repository\Contracts\AdvancedIndexRepository;
use Lpf\Support\Domain\Repository\Contracts\Repository;

interface UserRepository extends Repository, AdvancedIndexRepository
{
    public function softDelete(User $userModel);

    public function search($keyWord, array $columns = ['*']);

    public function attachRole(User $user, $role);

    public function detachRole(User $user, $role);
}
