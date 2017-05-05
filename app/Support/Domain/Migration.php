<?php

namespace Lpf\Support\Domain;

use Illuminate\Database\Migrations\Migration as LaravelMigration;

/**
 * Class Migration.
 *
 * Base Migration for usage inside domains.
 */
abstract class Migration extends LaravelMigration
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->schema = app('db')->connection()->getSchemaBuilder();

        $this->schema->disableForeignKeyConstraints();
    }

    /**
     * Run the migrations.
     */
    abstract public function up();

    /**
     * Reverse the migrations.
     */
    abstract public function down();

    public function __destruct()
    {
        $this->schema->enableForeignKeyConstraints();
    }
}