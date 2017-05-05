<?php

namespace Lpf\Domains\Location\Providers;

use Lpf\Domains\Location\Contracts;
use Lpf\Domains\Location\Database\Migrations;
use Lpf\Domains\Location\Database\Seeders;
use Lpf\Domains\Location\Repositories;
use Lpf\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider.
 *
 * Register Location Domain Resources and Services
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'location';

    /**
     * @var bool Enable translations
     */
    protected $hasTranslations = true;

    /**
     * @var array Providers registered within the domain
     */
    protected $subProviders = [
        EventServiceProvider::class,
    ];

    /**
     * @var array Bind contracts to implementations
     */
    protected $bindings = [
        Contracts\CityRepository::class => Repositories\CityRepository::class,
        Contracts\StateRepository::class => Repositories\StateRepository::class,
    ];

    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreateStatesTable::class,
        Migrations\CreateCitiesTable::class,
    ];

    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        Seeders\StatesSeeder::class,
        Seeders\CitiesSeeder::class,
    ];

    /**
     * @var array Model factories
     */
    protected $factories = [
        //
    ];
}
