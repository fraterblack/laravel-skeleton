<?php

namespace Lpf\Domains\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('contacts')->truncate();
        DB::table('contact_recipients')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \Lpf\Domains\CMS\ContactRecipient::create([
            'name' => 'Contato',
            'email' => 'edvaldo@agencianueva.com.br',
            'active' => 1
        ]);
    }
}
