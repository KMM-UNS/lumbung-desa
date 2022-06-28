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
            'belum diproses'
        ];

        foreach ($kondisihasilpanens as $kondisihasilpanen) :
            KondisiHasilPanen::firstOrCreate([
                'kondisi' => $kondisihasilpanen
            ]);
        endforeach;
    }
}
