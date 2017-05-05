<?php

namespace Lpf\Domains\Users\Database\Seeders;

use Artesaos\Defender\Facades\Defender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefenderRolesSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //DEFENDER ACL
        //Cria as funções dos usuários
        $admin = Defender::createRole('admin'); //admin
        $moderator = Defender::createRole('moderator'); //moderator

        //Permissões
        $adminPermission =  Defender::createPermission('admin', 'Administrador');
        $moderatorPermission =  Defender::createPermission('moderator', 'Moderador');

        $admin->attachPermission([ $adminPermission->id, $moderatorPermission->id ]);
        $moderator->attachPermission([ $moderatorPermission->id ]);

        $interactSitePermission =  Defender::createPermission('interact.site', 'Interagir Site');
    }
}
