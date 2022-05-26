<?php

namespace Database\Seeders;

use App\Models\KeteranganGudang;
use Illuminate\Database\Seeder;

class KeteranganGudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keterangangudangs = [
            'Mentah',
            'Olahan'
        ];

        foreach ($keterangangudangs as $keterangangudang) :
            KeteranganGudang::firstOrCreate([
                'nama' => $keterangangudang
            ]);
        endforeach;
    }
}
