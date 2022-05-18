<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MusimSeeder;
use Database\Seeders\SatuanSeeder;
use Database\Factories\UserFactory;
use Database\Seeders\SettingSeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\JenisTanamanSeeder;
use Database\Seeders\KondisiHasilPanenSeeder;
use Database\Seeders\KategoriKasSeeder;

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
            IndoRegionSeeder::class,
            KondisiHasilPanenSeeder::class,
            SettingSeeder::class,
            JenisTanamanSeeder::class,
            MusimSeeder::class,
            SatuanSeeder::class,
            KategoriKasSeeder::class,
        ]);
    }
}
