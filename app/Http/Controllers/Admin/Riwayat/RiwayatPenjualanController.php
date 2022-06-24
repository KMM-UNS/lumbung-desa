<?php

namespace App\Http\Controllers\Admin\Riwayat;

use App\Models\Penjualan;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RiwayatPenjualanController extends Controller
{
    public function index()
    {
        $data = Penjualan::get();
        // $penjualan = Penjualan::where('petani_id',$id)->get();
        return view('pages.admin.riwayat-transaksi.penjualan.index', ['data'=>$data]);
    }

    public function show($id)
    {
        $data = Penjualan::findOrFail($id);
        $penjualan = Penjualan::where('nama',$id)->get();
        dd($id);
        return view('pages.admin.riwayat-transaksi.penjualan.show', ['data'=>$data, 'penjualan'=>$penjualan]);
    }
}
