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
            'admin.user_roles' => 'Pode gerenciar permissões de usuário',
            'admin.general.settings' => 'Pode acessar configurações',
            'admin.galleries.albums' => 'Pode gerenciar álbuns',
            'admin.galleries.types' => 'Pode gerenciar tipos de álbuns',
            'admin.galleries.partners' => 'Pode gerenciar parceiros',
            'admin.banners' => 'Pode gerenciar banners',
            'admin.banners.places' => 'Pode gerenciar locais de banners',
            'admin.pages' => 'Pode gerenciar páginas',
            'admin.contact.recipients' => 'Pode gerenciar destinatários de contatos',
            'admin.contacts' => 'Pode gerenciar contatos',
        ];

        $adminPermissionIds = [];
        foreach ($adminPermissions as $key=>$name) {
            $createdPermission = Defender::createPermission($key, $name);

            $adminPermissionIds[] = $createdPermission->id;
        }
        $admin->attachPermission($adminPermissionIds);
    }
}
