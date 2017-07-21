<?php

namespace Lpf\Support\Generators\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function register()
    {
        $this->registerCommands();
    }

    private function registerCommands()
    {
        $this->commands(\Lpf\Support\Generators\Commands\RepositoryMakeCommand::class);
        $this->commands(\Lpf\Support\Generators\Commands\RepositoryContractMakeCommand::class);

        $this->commands(\Lpf\Support\Generators\Commands\ServiceMakeCommand::class);
        $this->commands(\Lpf\Support\Generators\Commands\ServiceContractMakeCommand::class);
    }
}
