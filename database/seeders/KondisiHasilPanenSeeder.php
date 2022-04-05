<?php

namespace Database\Seeders;

use App\Models\KondisiHasilPanen;
use Illuminate\Database\Seeder;

class KondisiHasilPanenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kondisihasilpanens = [
            'digiling',
            'dikeringkan',
        ];

        foreach ($kondisihasilpanens as $kondisihasilpanens) :
            KondisiHasilPanen::firstOrCreate([
                'kondisi' => $kondisihasilpanens
            ]);
        endforeach;
    }
}
