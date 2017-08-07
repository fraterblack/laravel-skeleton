<?php

namespace Lpf\Domains\Users\Providers;

use Lpf\Domains\Users\Contracts;
use Lpf\Domains\Users\Database\Factories;
use Lpf\Domains\Users\Database\Migrations;
use Lpf\Domains\Users\Database\Seeders;
use Lpf\Domains\Users\Repositories;
use Lpf\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider.
 *
 * Register Users Domain Resources and Services
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'users';

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
        Contracts\UserRepository::class => Repositories\UserRepository::class,
    ];

    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreateUsersTable::class,
        Migrations\CreatePasswordResetsTable::class,
        Migrations\CreateDefenderRolesTable::class,
        Migrations\CreateDefenderPermissionsTable::class,
        Migrations\CreateDefenderRoleUserTable::class,
        Migrations\CreateDefenderPermissionUserTable::class,
        Migrations\CreateDefenderPermissionRoleTable::class,
    ];

    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        Seeders\DefenderRolesSeeder::class,
        Seeders\UsersSeeder::class,
    ];

    /**
     * @var array Model factories
     */
    protected $factories = [
        Factories\UserFactory::class
    ];
}
