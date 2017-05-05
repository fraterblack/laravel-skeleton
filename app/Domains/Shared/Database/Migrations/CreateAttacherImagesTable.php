<?php

namespace Lpf\Domains\Shared\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateAttacherImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('attacher_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->unsignedInteger('subject_id')->index();
            $table->string('subject_type')->index();
            $table->string('file_extension');
            $table->string("file_name")->nullable();
            $table->smallInteger("file_size", false, true)->nullable();
            $table->string("mime_type")->nullable();
            $table->timestamp('image_updated_at')->nullable();
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
        $this->schema->drop('attacher_images');
    }
}
