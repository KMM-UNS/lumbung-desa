<?php

namespace App\Http\Controllers\Admin\GudangLumbung;

use App\DataTables\Admin\GudangLumbung\LaporanGudangProdukDataTable;
use App\Http\Controllers\Controller;
use App\Models\GudangLumbung;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class LaporanGudangController extends Controller
{
    public function index(LaporanGudangProdukDataTable $dataTable)
    {
        $produks = Tanaman::get();
        $produkWithStok = array();

        foreach ($produks as $produk) {
            $stok = GudangLumbung::where('nama_tanaman_id', $produk->id)->sum('stok');
            $produkWithStok[$produk->nama] = $stok;
        }
        // dd($stok);

        return $dataTable->render('pages.admin.laporan-gudang.index', [
            'produkWithStok' => $produkWithStok,
        ]);
    }

    public function show($id)
    {
        //
    }
}
