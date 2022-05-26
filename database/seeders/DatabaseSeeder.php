<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MusimSeeder;
use Database\Seeders\SatuanSeeder;
use Database\Factories\UserFactory;
use Database\Seeders\SettingSeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\JenisLahanSeeder;
use Database\Seeders\JenisTanamanSeeder;
use Database\Seeders\KondisiHasilPanenSeeder;
use Database\Seeders\KategoriKasSeeder;
use Database\Seeders\KeteranganGudang;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // IndoRegionSeeder::class,
            SettingSeeder::class,
            JenisLahanSeeder::class,
            KondisiHasilPanenSeeder::class,
            SettingSeeder::class,
            JenisTanamanSeeder::class,
            MusimSeeder::class,
            SatuanSeeder::class,
            KategoriKasSeeder::class,
            KeteranganGudangSeeder::class,
        ]);
    }
}
