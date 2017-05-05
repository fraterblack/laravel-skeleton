<?php

namespace Lpf\Domains\CMS\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateBannerPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('banner_places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('description', 255);
            $table->text('accepted_types');
            $table->string('background_color', 7);
            $table->smallInteger('width', false, true);
            $table->smallInteger('height', false, true);
            $table->tinyInteger('display', false, true)->default(1);
            $table->tinyInteger('limit', false, true)->default(1);
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
        $this->schema->drop('banner_places');
    }
}
