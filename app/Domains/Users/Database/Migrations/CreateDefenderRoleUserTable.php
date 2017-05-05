<?php

namespace Lpf\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateDefenderRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('defender.role_user_table', 'role_user'), function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('cascade');

            $table->integer(config('defender.role_key', 'role_id'))->unsigned()->index();
            $table->foreign(config('defender.role_key', 'role_id'))->references('id')
                ->on(config('defender.role_table', 'roles'))
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->table(config('defender.role_user_table', 'role_user'), function (Blueprint $table) {
            $table->dropForeign(config('defender.role_user_table', 'role_user').'_user_id_foreign');
            $table->dropForeign(config('defender.role_user_table', 'role_user').'_'.config('defender.role_key', 'role_id').'_foreign');
        });

        $this->schema->drop(config('defender.role_user_table', 'role_user'));
    }
}
