<?php

namespace Lpf\Applications\Panel\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Lpf\Applications\Panel\Routes\AuthWeb;
use Lpf\Applications\Panel\Routes\Console;
use Lpf\Applications\Panel\Routes\Web;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Lpf\Applications\Panel\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapAuthWebRoutes();

        $this->mapConsoleRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        (new Web([
            'middleware' => ['web', 'auth', 'needsPermission:admin'],
            'namespace'  => $this->namespace,
            'as'         => 'admin.',
            'prefix'     => 'admin',
        ]))->register();
    }

    /**
     * Define the "auth web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapAuthWebRoutes()
    {
        (new AuthWeb([
            'middleware' => ['web'],
            'namespace'  => $this->namespace,
            'as'         => 'admin.',
            'prefix'     => 'admin',
        ]))->register();
    }

    /**
     * Define the "console" routes for the application.
     *
     * Those routes are the ones defined by
     * artisan->command instead of registered directly
     * on the ConsoleKernel.
     */
    protected function mapConsoleRoutes()
    {
        (new Console())->register();
    }
}
