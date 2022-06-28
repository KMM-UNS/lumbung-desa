<?php

namespace Database\Seeders;

use App\Models\StatusKawin;
use Illuminate\Database\Seeder;

class StatusKawinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'KAWIN',
            'BELUM KAWIN'
        ];

        foreach ($status as $data) :
            StatusKawin::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
