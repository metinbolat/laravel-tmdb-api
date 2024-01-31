<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'tmdb_id' => '28',
                'name' => 'Aksiyon',
                'slug' => 'aksiyon',
            ],
            [
                'tmdb_id' => '12',
                'name' => 'Macera',
                'slug' => 'macera',
            ],
            [
                'tmdb_id' => '16',
                'name' => 'Animasyon',
                'slug' => 'animasyon',
            ],
            [
                'tmdb_id' => '35',
                'name' => 'Komedi',
                'slug' => 'komedi',
            ],
            [
                'tmdb_id' => '80',
                'name' => 'Suç',
                'slug' => 'suc',
            ],
            [
                'tmdb_id' => '99',
                'name' => 'Belgesel',
                'slug' => 'belgesel',
            ],
            [
                'tmdb_id' => '18',
                'name' => 'Dram',
                'slug' => 'dram',
            ],
            [
                'tmdb_id' => '10751',
                'name' => 'Aile',
                'slug' => 'aile',
            ],
            [
                'tmdb_id' => '14',
                'name' => 'Fantastik',
                'slug' => 'fantastik',
            ],
            [
                'tmdb_id' => '36',
                'name' => 'Tarih',
                'slug' => 'tarih',
            ],
            [
                'tmdb_id' => '27',
                'name' => 'Korku',
                'slug' => 'korku',
            ],
            [
                'tmdb_id' => '10402',
                'name' => 'Müzik',
                'slug' => 'muzik',
            ],
            [
                'tmdb_id' => '9648',
                'name' => 'Gizem',
                'slug' => 'gizem',
            ],
            [
                'tmdb_id' => '10749',
                'name' => 'Romantik',
                'slug' => 'romantik',
            ],
            [
                'tmdb_id' => '878',
                'name' => 'Bilim Kurgu',
                'slug' => 'bilim-kurgu',
            ],
            [
                'tmdb_id' => '10770',
                'name' => 'TV Film',
                'slug' => 'tv-film',
            ],
            [
                'tmdb_id' => '53',
                'name' => 'Gerilim',
                'slug' => 'gerilim',
            ],
            [
                'tmdb_id' => '10752',
                'name' => 'Savaş',
                'slug' => 'savas',
            ],
            [
                'tmdb_id' => '37',
                'name' => 'Vahşi Batı',
                'slug' => 'vahsi-bati',
            ]
        ]);
    }
}
