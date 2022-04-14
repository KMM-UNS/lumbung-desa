<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuans = [
            'kg',
            'kwintal',
            'ton',
        ];

        foreach ($satuans as $satuan) :
            Satuan::firstOrCreate([
                'satuan' => $satuan
            ]);
        endforeach;
    }
}
