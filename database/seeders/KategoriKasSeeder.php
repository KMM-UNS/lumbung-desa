<?php

namespace Database\Seeders;

use App\Models\KategoriKas;
use Illuminate\Database\Seeder;

class KategoriKasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategorikass = [
            'Debit',
            'Kredit'
        ];

        foreach ($kategorikass as $kategorikas) :
            KategoriKas::firstOrCreate([
                'nama' => $kategorikas
            ]);
        endforeach;
    }
}
