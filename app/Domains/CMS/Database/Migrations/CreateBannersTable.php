<?php

namespace Lpf\Domains\CMS\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('type', 20);
            $table->text('code');
            $table->string('url', 255);
            $table->boolean('open_in_new_window')->default(0);
            $table->string('background_color', 7);
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->integer('banner_place_id')->unsigned()->index();
            $table->foreign('banner_place_id')->references('id')->on('banner_places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('banners');
    }
}
