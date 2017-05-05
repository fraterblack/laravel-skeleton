<?php

namespace Lpf\Support\Services\Mail\Providers;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(
            \Lpf\Support\Services\Mail\Contracts\MailService::class,
            \Lpf\Support\Services\Mail\MailerService::class
        );
    }
}