<?php

namespace Lpf\Applications\Panel\Providers;

use Lpf\Support\Applications\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{
    protected $alias = 'panel';

    protected $hasViews = true;

    protected $hasTranslations = true;

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
