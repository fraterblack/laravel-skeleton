<?php

namespace Lpf\Support\Services\Mail\Contracts;

use Closure;
use Illuminate\Database\Eloquent\Model;

interface AclMailService
{
    public function newUserNotification(Model $user, $password, Closure $callback = null);

    public function updatedUserNotification(Model $user, $password = null, Closure $callback = null);
}