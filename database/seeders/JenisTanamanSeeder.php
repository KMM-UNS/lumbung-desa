<?php

namespace Database\Seeders;

use App\Models\JenisTanaman;
use Illuminate\Database\Seeder;

class JenisTanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenistanamans = [
            'Padi',
            'Jagung',
            'Kentang',
            'Kacang',
        ];

        foreach ($jenistanamans as $jenistanaman) :
            JenisTanaman::firstOrCreate([
                'nama' => $jenistanaman
            ]);
        endforeach;
    }
}
