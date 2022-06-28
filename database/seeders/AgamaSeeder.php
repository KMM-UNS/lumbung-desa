<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religions = [
            'Islam',
            'Kristen Khatolik',
            'Kristen Protestan',
            'Hindu',
            'Budha',
            'Khonghucu',
            'Kepercayaan Terhadap Tuhan YME',
            'Penghayat Kepercayaan'
        ];

        foreach ($religions as $religion) :
            Agama::firstOrCreate([
                'nama' => $religion
            ]);
        endforeach;
    }
}
