<?php

namespace Database\Seeders;

use App\Models\Musim;
use Illuminate\Database\Seeder;

class MusimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $musims = [
            'Utama',
            'Tanam Kemarau',
            'Tanam Gandu',
        ];

        foreach ($musims as $musim) :
            Musim::firstOrCreate([
                'nama' => $musim
            ]);
        endforeach;    }
}
