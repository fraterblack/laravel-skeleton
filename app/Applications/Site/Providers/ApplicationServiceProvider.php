<?php

namespace Lpf\Applications\Site\Providers;

use Lpf\Support\Applications\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{
    protected $alias = 'site';

    protected $hasViews = true;

    protected $hasTranslations = true;

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
