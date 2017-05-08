<?php

namespace Lpf\Domains\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Lpf\Domains\Users\User;
use Artesaos\Defender\Facades\Defender;

/**
 * Class UsersSeeders.
 */
class UsersSeeder extends Seeder
{
    /**
     * @todo improve users seeders
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        //Usuário Administrador
        $superUser = User::create([
            'name' => 'Edvaldo da Rosa',
            'email' => 'contato@bck.com.br',
            'password' => bcrypt('123456'),
            'active' => 1
        ]);

        //ACL
        $masterRole = Defender::findRole('master');
        //$adminRole = \Artesaos\Defender\Facades\Defender::findRole('admin');

        //Atribua permissões ao super usuário
        $superUser = User::find(1);
        $superUser->attachRole($masterRole);
        //$superUser->attachRole($adminRole);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
