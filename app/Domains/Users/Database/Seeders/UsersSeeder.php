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

        //Usuário Master
        $superUser = User::create([
            'name' => 'Usuário Teste',
            'email' => 'teste@teste.com.br',
            'password' => bcrypt('123456'),
            'active' => 1
        ]);

        //ACL
        $masterRole = Defender::findRole('master');

        //Atribue permissão master para o super usuário (Primeiro usuário)
        $superUser->attachRole($masterRole);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
