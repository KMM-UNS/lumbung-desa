<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Database\Seeders\SettingSeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\KondisiHasilPanenSeeder;

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
            SettingSeeder::class
        ]);
    }
}
