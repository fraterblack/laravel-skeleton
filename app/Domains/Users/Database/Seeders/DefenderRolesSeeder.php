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
        $master = Defender::createRole('master'); //master

        $masterPermission = Defender::createPermission('master', 'Tem acesso a todos os recursos do painel');
        $master->attachPermission([ $masterPermission->id ]);

        $admin = Defender::createRole('admin'); //admin

        $adminPermissions = [
            'admin' => 'Acessa o painel',
            'admin.users' => 'Pode gerenciar usuários',
            'admin.user_roles' => 'Pode gerenciar funções de usuário',
            'admin.general.settings' => 'Pode acessar configurações',
        ];

        $adminPermissionIds = [];
        foreach ($adminPermissions as $key=>$name) {
            $createdPermission = Defender::createPermission($key, $name);

            $adminPermissionIds[] = $createdPermission->id;
        }
        $admin->attachPermission($adminPermissionIds);
    }
}
