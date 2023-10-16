<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'site_name' => 'Site Adı',
                'site_email' => 'adres@domain.com',
                'site_description' => 'Site Açıklaması',
                'site_logo' => 'logo.png',
                'site_favicon' => 'favicon.ico',
                'site_separator' => '-',
                'site_footertext' => 'Footer Metni',
                'comment_approval' => 0
            ],

        ]);
    }
}
