<?php

namespace Lpf\Domains\Users\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Lpf\Domains\Users\Events;
use Lpf\Domains\Users\Listeners;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        Events\NewUserEvent::class => [
            Listeners\NewUserNotification::class
        ],
        Events\UpdatedUserEvent::class => [
            Listeners\UpdatedUserNotification::class
        ],
    ];
}
