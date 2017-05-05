<?php

namespace Lpf\Domains\CMS\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateContactRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('contact_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('email');
            $table->boolean('active')->default(1);
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
        $this->schema->drop('contact_recipients');
    }
}
