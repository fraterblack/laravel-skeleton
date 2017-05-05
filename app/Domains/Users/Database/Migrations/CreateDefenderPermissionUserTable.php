<?php

namespace Lpf\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateDefenderPermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('defender.permission_user_table', 'permission_user'), function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('cascade');

            $table->integer(config('defender.permission_key', 'permission_id'))->unsigned()->index();
            $table->foreign(config('defender.permission_key', 'permission_id'))->references('id')
                ->on(config('defender.permission_table', 'permissions'))
                ->onDelete('cascade');

            $table->tinyInteger('value')->default(-1);
            $table->timestamp('expires')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->table(config('defender.permission_user_table', 'permission_user'), function (Blueprint $table) {
            $table->dropForeign(config('defender.permission_user_table', 'permission_user').'_user_id_foreign');
            $table->dropForeign(config('defender.permission_user_table', 'permission_user').'_'.config('defender.permission_key', 'permission_id').'_foreign');
        });

        $this->schema->drop(config('defender.permission_user_table', 'permission_user'));
    }
}
