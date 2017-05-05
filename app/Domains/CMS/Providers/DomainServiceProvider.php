<?php

namespace Lpf\Domains\CMS\Providers;

use Lpf\Domains\CMS\Contracts;
use Lpf\Domains\CMS\Database\Factories;
use Lpf\Domains\CMS\Database\Migrations;
use Lpf\Domains\CMS\Database\Seeders;
use Lpf\Domains\CMS\Repositories;
use Lpf\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider.
 *
 * Register CMS Domain Resources and Services
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'CMS';

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
        Contracts\PageRepository::class => Repositories\PageRepository::class,
        Contracts\BannerPlaceRepository::class => Repositories\BannerPlaceRepository::class,
        Contracts\BannerRepository::class => Repositories\BannerRepository::class,
        Contracts\ContactRecipientRepository::class => Repositories\ContactRecipientRepository::class,
        Contracts\ContactRepository::class => Repositories\ContactRepository::class,
    ];

    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreatePagesTable::class,
        Migrations\CreateBannerPlacesTable::class,
        Migrations\CreateBannersTable::class,
        Migrations\CreateContactRecipientsTable::class,
        Migrations\CreateContactsTable::class,
        Migrations\AddRandColumnInBannerPlacesTable::class,
    ];

    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        Seeders\PagesSeeder::class,
        Seeders\BannersSeeder::class,
        Seeders\ContactsSeeder::class,
    ];

    /**
     * @var array Model factories
     */
    protected $factories = [];
}
