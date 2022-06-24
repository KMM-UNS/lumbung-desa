<?php

namespace App\Http\Controllers\Admin\Riwayat;

use App\Models\Pembelian;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RiwayatPembelianController extends Controller
{
    public function index()
    {
        $data = DataPetani::get();
        // $pembelian = Pembelian::where('petani_id',$id)->get();
        return view('pages.admin.riwayat-transaksi.pembelian.index', ['data'=>$data]);
    }

    public function show($id)
    {
        $data = DataPetani::findOrFail($id);
        $pembelian = Pembelian::get();
        dd($id);
        return view('pages.admin.riwayat-transaksi.pembelian.show', ['data'=>$data, 'pembelian'=>$pembelian]);
    }
}
