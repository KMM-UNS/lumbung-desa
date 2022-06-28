<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendidikans = [
            'SD/MI',
            'SMP/Mts',
            'SMA/SMK/MA',
            'Diploma',
            'S1',
            'S2',
            'S3',
        ];

        foreach ($pendidikans as $data) :
            Pendidikan::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
