<?php

namespace Lpf\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Lpf\Support\Domain\Migration;

class CreateDefenderPermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('defender.permission_role_table', 'permission_role'), function (Blueprint $table) {
            $table->integer(config('defender.permission_key', 'permission_id'))->unsigned()->index();
            $table->foreign(config('defender.permission_key', 'permission_id'))->references('id')
                ->on(config('defender.permission_table', 'permissions'))
                ->onDelete('cascade');

            $table->integer(config('defender.role_key', 'role_id'))->unsigned()->index();
            $table->foreign(config('defender.role_key', 'role_id'))->references('id')
                ->on(config('defender.role_table', 'roles'))
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
        $this->schema->table(config('defender.permission_role_table', 'permission_role'), function (Blueprint $table) {
            $table->dropForeign(config('defender.permission_role_table', 'permission_role').'_'.config('defender.permission_key', 'permission_id').'_foreign');
            $table->dropForeign(config('defender.permission_role_table', 'permission_role').'_'.config('defender.role_key', 'role_id').'_foreign');
        });

        $this->schema->drop(config('defender.permission_role_table', 'permission_role'));
    }
}
