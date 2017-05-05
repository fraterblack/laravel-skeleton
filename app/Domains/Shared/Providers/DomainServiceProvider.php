<?php

namespace Lpf\Domains\Shared\Providers;

use Lpf\Domains\Shared\Contracts;
use Lpf\Domains\Shared\Database\Migrations;
use Lpf\Domains\Shared\Database\Seeders;
use Lpf\Domains\Shared\Repositories;
use Lpf\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider.
 *
 * Register Shared Domain Resources and Services
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'shared';

    /**
     * @var bool Enable translations
     */
    protected $hasTranslations = false;

    /**
     * @var array Providers registered within the domain
     */
    protected $subProviders = [
        //
    ];

    /**
     * @var array Bind contracts to implementations
     */
    protected $bindings = [
        Contracts\AttacherRepository::class => Repositories\AttacherRepository::class,
    ];

    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreateAttacherImagesTable::class,
        Migrations\CreateLogsTable::class,
        Migrations\CreateJobsTable::class,
        Migrations\CreateFailedJobsTable::class,
    ];

    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        Seeders\AttacherImagesSeeder::class,
    ];

    /**
     * @var array Model factories
     */
    protected $factories = [
        //
    ];
}
