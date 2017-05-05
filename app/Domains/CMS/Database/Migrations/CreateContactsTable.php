<?php

namespace Lpf\Domains\CMS\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 80);
            $table->string('email', 100);
            $table->string('subject');
            $table->text('message');
            $table->boolean('sent')->default(0);
            $table->boolean('replied')->default(0);
            $table->string('ip');

            $table->string('city', 100);
            $table->string('state', 50);
            $table->string('telephone_1', 20);
            $table->string('telephone_2', 20);
            $table->string('origin', 30);

            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();

            $table->integer('contact_recipient_id')->unsigned()->index();
            $table->foreign('contact_recipient_id')->references('id')->on('contact_recipients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('contacts');
    }
}
