<?php

namespace Lpf\Domains\CMS\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class AddAvailabilitiesColumnsInBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->table('banners', function (Blueprint $table) {
            $table->dateTime('availability_from')->nullable();
            $table->dateTime('availability_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->table('banners', function (Blueprint $table) {
            $table->dropColumn(['availability_from', 'availability_to']);
        });
    }
}
