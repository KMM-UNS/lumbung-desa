<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MusimSeeder;
use Database\Seeders\SatuanSeeder;
use Database\Factories\UserFactory;
use Database\Seeders\SettingSeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\PendidikanSeeder;
use Database\Seeders\StatusKawinSeeder;
use Database\Seeders\KeperluanSkckSeeder;
use Database\Seeders\StatusKeluargaSeeder;
use Database\Seeders\ObjekPengawalanSeeder;
use Database\Seeders\JenisLahanSeeder;
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
            AgamaSeeder::class,
            PekerjaanSeeder::class,
            PendidikanSeeder::class,
            StatusKawinSeeder::class,
            SettingSeeder::class,
            JenisLahanSeeder::class,
            KondisiHasilPanenSeeder::class,
            SettingSeeder::class,
            JenisTanamanSeeder::class,
            MusimSeeder::class,
            SatuanSeeder::class,
            KategoriKasSeeder::class,
        ]);
    }
}
