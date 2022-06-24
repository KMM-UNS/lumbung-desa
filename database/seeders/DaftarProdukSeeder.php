<?php

namespace Database\Seeders;

use App\Models\DaftarProduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class DaftarProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('daftar_produks')->insert([
        ['nama'=>'Padi C1','kondisi'=>'1','keterangan'=>'1','harga_beli'=>'9000','harga_jual'=>'15000',],
        ['nama'=>'Padi C1','kondisi'=>'2','keterangan'=>'1','harga_beli'=>'8500','harga_jual'=>'16000',],
        ['nama'=>'Padi C1','kondisi'=>'3','keterangan'=>'1','harga_beli'=>'7000','harga_jual'=>'12500',],
        ['nama'=>'Padi C1','kondisi'=>'1','keterangan'=>'2','harga_beli'=>'6500','harga_jual'=>'11000',],
        ['nama'=>'Padi C1','kondisi'=>'2','keterangan'=>'2','harga_beli'=>'11000','harga_jual'=>'14000',],
        ['nama'=>'Padi C1','kondisi'=>'3','keterangan'=>'2','harga_beli'=>'9500','harga_jual'=>'13500',],
        ['nama'=>'Padi CL 220','kondisi'=>'1','keterangan'=>'1','harga_beli'=>'9500','harga_jual'=>'14000',],
        ['nama'=>'Padi CL 220','kondisi'=>'2','keterangan'=>'1','harga_beli'=>'7000','harga_jual'=>'10000',],
        ['nama'=>'Padi CL 220','kondisi'=>'3','keterangan'=>'1','harga_beli'=>'11000','harga_jual'=>'17000',],
        ['nama'=>'Padi CL 220','kondisi'=>'1','keterangan'=>'2','harga_beli'=>'15000','harga_jual'=>'19000',],

       ]
    );

        // $kondisis = [
        //     'Digiling',
        //     'Dikeringkan ',
        //     'Belum diproses ',

        // ];

        // foreach ($kondisis as $kondisi) :
        //     DaftarProduk::firstOrCreate([
        //         'kondisi' => $kondisi
        //     ]);
        // endforeach;
    }
}
