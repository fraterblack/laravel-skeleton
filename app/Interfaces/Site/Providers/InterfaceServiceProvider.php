<?php

namespace Lpf\Interfaces\Site\Providers;

use Lpf\Support\Interfaces\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    protected $alias = 'site';

    protected $hasViews = true;

    protected $hasTranslations = true;

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
