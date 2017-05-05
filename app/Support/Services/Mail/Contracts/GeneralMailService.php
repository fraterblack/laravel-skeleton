<?php

namespace Lpf\Support\Services\Mail\Contracts;

use Closure;
use Illuminate\Database\Eloquent\Model;

interface GeneralMailService
{
    public function sendContact(Model $contact, Closure $callback = null);
}