<?php

namespace Lpf\Interfaces\Panel\Providers;

use Lpf\Support\Interfaces\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    protected $alias = 'panel';

    protected $hasViews = true;

    protected $hasTranslations = true;

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
