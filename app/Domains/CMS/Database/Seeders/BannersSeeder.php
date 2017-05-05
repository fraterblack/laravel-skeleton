<?php

namespace Lpf\Domains\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('banners')->truncate();
        DB::table('banner_places')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
