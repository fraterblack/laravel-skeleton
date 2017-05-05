<?php

namespace Lpf\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateDefenderRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('defender.role_table', 'roles'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop(config('defender.role_table', 'roles'));
    }
}
