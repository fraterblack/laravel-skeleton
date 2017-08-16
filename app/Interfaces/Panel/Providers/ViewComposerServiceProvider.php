<?php

namespace Lpf\Interfaces\Panel\Providers;

use Lpf\Interfaces\Panel\Http\ViewComposers\IndexFilterComposer;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Lpf\Interfaces\Panel\Http\ViewComposers\MainMenuComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeIndexFilter();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Compoe conteúdo relativo ao filtro de na listagem de cadastros
     */
    private function composeIndexFilter()
    {
      view()->composer(['panel::_partial.indexFilter.inputs'], IndexFilterComposer::class);
        view()->composer(['panel::_partial.mainMenu.menu'], MainMenuComposer::class);
    }
}
