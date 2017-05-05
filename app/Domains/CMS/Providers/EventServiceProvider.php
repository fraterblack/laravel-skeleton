<?php

namespace Lpf\Domains\CMS\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Lpf\Domains\CMS\Events;
use Lpf\Domains\CMS\Listeners;
use Lpf\Domains\CMS\Observers\BannerObserver;
use Lpf\Domains\CMS\Observers\BannerPlaceObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        Events\NewContactEvent::class => [
            Listeners\SendContact::class
        ],
    ];
}
