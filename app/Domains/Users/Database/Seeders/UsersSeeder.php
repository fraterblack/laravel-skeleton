<?php

namespace Lpf\Domains\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Lpf\Domains\Users\User;

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

        //Permissões
        $adminRole = \Artesaos\Defender\Facades\Defender::findRole('admin');

        //Atribua permissões ao super usuário
        $superUser->attachRole($adminRole);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
