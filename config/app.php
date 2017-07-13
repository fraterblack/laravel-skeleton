<?php

return [

    'env' => env('APP_ENV', 'production'),

    'display_test_alert' => env('DISPLAY_TEST_ALERT', false),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => (env('APP_SECURE') ? 'https://' : 'http://') . env('APP_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Application URL (Domain Only)
    |--------------------------------------------------------------------------
    |
    | Application Domain without protocol.
    |
    */

    'domain' => env('APP_DOMAIN', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL (HTTPS Enabled)
    |--------------------------------------------------------------------------
    |
    | Application URL should be HTTPS?.
    |
    */

    'secure' => env('APP_SECURE', false),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'America/Sao_Paulo',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'pt-BR',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY', 'SomeRandomString'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => 'single',

    'log_max_files' => env('APP_LOG_MAX_FILES', 10), //For 'daily' logs

    'log_level' => env('APP_LOG_LEVEL', 'error'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Migrator\MigrationServiceProvider::class,
        Artesaos\Warehouse\WarehouseServiceProvider::class,
        Artesaos\Defender\Providers\DefenderServiceProvider::class,
        Artesaos\Attacher\Providers\AttacherServiceProvider::class,
        Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class,
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,
        OwenIt\Auditing\AuditingServiceProvider::class,
        Rutorika\Sortable\SortableServiceProvider::class,
        Sofa\Eloquence\ServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        Mews\Purifier\PurifierServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,

        /*
         * Support Service Providers...
         */
        Lpf\Support\Services\Mail\Providers\MailServiceProvider::class,

        /**
         * Domains Service Providers...
         */
        Lpf\Domains\Shared\Providers\DomainServiceProvider::class,
        Lpf\Domains\Location\Providers\DomainServiceProvider::class,
        Lpf\Domains\Users\Providers\DomainServiceProvider::class,
        Lpf\Domains\CMS\Providers\DomainServiceProvider::class,

        /*
         * Interfaces Service Providers...
         */
        Lpf\Interfaces\Panel\Providers\InterfaceServiceProvider::class,
        Lpf\Interfaces\Site\Providers\InterfaceServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        'Auth'      => Illuminate\Support\Facades\Auth::class,
        'Blade'     => Illuminate\Support\Facades\Blade::class,
        'Bus'       => Illuminate\Support\Facades\Bus::class,
        'Cache'     => Illuminate\Support\Facades\Cache::class,
        'Config'    => Illuminate\Support\Facades\Config::class,
        'Cookie'    => Illuminate\Support\Facades\Cookie::class,
        'Crypt'     => Illuminate\Support\Facades\Crypt::class,
        'DB'        => Illuminate\Support\Facades\DB::class,
        'Eloquent'  => Illuminate\Database\Eloquent\Model::class,
        'Event'     => Illuminate\Support\Facades\Event::class,
        'File'      => Illuminate\Support\Facades\File::class,
        'Gate'      => Illuminate\Support\Facades\Gate::class,
        'Hash'      => Illuminate\Support\Facades\Hash::class,
        'Input'     => Illuminate\Support\Facades\Input::class,
        'Inspiring' => Illuminate\Foundation\Inspiring::class,
        'Lang'      => Illuminate\Support\Facades\Lang::class,
        'Log'       => Illuminate\Support\Facades\Log::class,
        'Mail'      => Illuminate\Support\Facades\Mail::class,
        'Password'  => Illuminate\Support\Facades\Password::class,
        'Queue'     => Illuminate\Support\Facades\Queue::class,
        'Redirect'  => Illuminate\Support\Facades\Redirect::class,
        'Redis'     => Illuminate\Support\Facades\Redis::class,
        'Request'   => Illuminate\Support\Facades\Request::class,
        'Response'  => Illuminate\Support\Facades\Response::class,
        'Route'     => Illuminate\Support\Facades\Route::class,
        'Schema'    => Illuminate\Support\Facades\Schema::class,
        'Session'   => Illuminate\Support\Facades\Session::class,
        'Storage'   => Illuminate\Support\Facades\Storage::class,
        'URL'       => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View'      => Illuminate\Support\Facades\View::class,

        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Defender' => Artesaos\Defender\Facades\Defender::class,
        'Attacher'   => Artesaos\Attacher\Facades\Attacher::class,
        'SEOMeta'   => Artesaos\SEOTools\Facades\SEOMeta::class,
        'OpenGraph' => Artesaos\SEOTools\Facades\OpenGraph::class,
        'Twitter'   => Artesaos\SEOTools\Facades\TwitterCard::class,
        'SEO' => Artesaos\SEOTools\Facades\SEOTools::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'Purifier' => Mews\Purifier\Facades\Purifier::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | CSRF Exceptions
    |--------------------------------------------------------------------------
    |
    | Rotas específicas que a verificação CSRF não deve ser aplicada
    |
    */

    'no_csrf' => [
        '/admin/*/upload-imagens',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Configurations
    |--------------------------------------------------------------------------
    |
    | Configurações específicas do painel de administração
    |
    */
    'admin' => [
        //Admin URL
        'url' => env('ADMIN_URL', ''),

        //Developer Information
        'developer' => [
            'logo' => '/images/panel/logo-nueva.png',
            'title' => 'Desenvolvido por Agência Nueva',
            'url' => 'http://www.agencianueva.com.br'
        ],

        //Contractor Information
        'contractor' => [
            'logo' => '/images/panel/logo-cliente.png',
            'name' => 'Loucos por Festa'
        ]
    ]
];
