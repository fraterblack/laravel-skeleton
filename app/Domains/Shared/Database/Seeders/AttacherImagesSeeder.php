<?php

namespace Lpf\Domains\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttacherImagesSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //Limpa imagens de uploads anteriores
        Storage::deleteDir('/uploads/images/');

        //Attacher Images
        DB::table('attacher_images')->truncate();

        //Logs
        DB::table('logs')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
