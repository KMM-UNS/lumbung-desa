<?php

namespace Database\Seeders;

use App\Models\DataJenisLahan;
use Illuminate\Database\Seeder;

class JenisLahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_lahans = [
            'Lahan Tadah Hujan',
            'Lahan Semi Tadah Hujan ',
            'Lahan Irigasi ',
            'Lahan Kebun/Palawija',
            
        ];

        foreach ($jenis_lahans as $jenis_lahan) :
            DataJenisLahan::firstOrCreate([
                'nama' => $jenis_lahan
            ]);
        endforeach;
    }
}
