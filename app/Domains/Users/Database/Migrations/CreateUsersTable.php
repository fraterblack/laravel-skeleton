<?php

namespace Lpf\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Database\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->schema->dropIfExists('users');

        $this->schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        //$this->schema->drop('users');
    }
}