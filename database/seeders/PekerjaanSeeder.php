<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Illuminate\Database\Seeder;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pekerjaans = [
            'Pelajar/Mahasiswa',
            'Nelayan',
            'Petani',
            'Karyawan',
            'PNS',
            'Guru',
            'Dosen'
        ];

        foreach ($pekerjaans as $pekerjaan) :
            Pekerjaan::firstOrCreate([
                'nama' => $pekerjaan
            ]);
        endforeach;
    }
}
