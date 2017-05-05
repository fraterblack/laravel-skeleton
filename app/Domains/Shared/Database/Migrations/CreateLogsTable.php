<?php

namespace Lpf\Domains\Shared\Database\Migrations;

use Lpf\Support\Domain\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('logs', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('owner_type');
            $table->integer('owner_id');
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->string('type');
            $table->string('route')->nullable();
            $table->string('ip', 45)->nullable();
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
        $this->schema->drop('logs');
    }
}
