<?php

namespace Lpf\Domains\Location\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->char('abbreviation', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('states');
    }
}
