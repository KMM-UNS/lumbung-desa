<?php

namespace App\Http\Controllers\Admin\Riwayat;

use App\Models\Penjualan;
use App\Models\DataPembeli;
use Illuminate\Http\Request;
use App\Models\PenjualanProduk;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\RiwayatPenjualan\RiwayatPenjualanProdukDataTable;
use App\DataTables\Admin\RiwayatPenjualan\DetailRiwayatPenjualanProdukDataTable;

class RiwayatPenjualanProdukController extends Controller
{
    public function index(RiwayatPenjualanProdukDataTable $dataTable)
    {
        // $data = DataPembeli::has('pembeli')->get();
        return $dataTable->render('pages.admin.riwayat-transaksi.riwayatpenjualanproduk.index', [
        // return view('pages.admin.riwayat-transaksi.pembelian.index', [
            // 'data'=>$data
        ]);
    }

    public function show(DetailRiwayatPenjualanProdukDataTable $dataTable, $id)
    {
        // $data = DataPetani::findOrFail($id);
        // $pembelian = Pembelian::get();
        // $data['data'] = Pembelian::where('petani_id', $id)->get();
        $data=PenjualanProduk::select('nama_petani')->where('nama_petani', $id);
        // $datapembeli=DataPembeli::findOrFail($id);
        // dd($id);
        return $dataTable->render('pages.admin.riwayat-transaksi.riwayatpenjualanproduk.show', [
        // return view('pages.admin.riwayat-transaksi.pembelian.show', [
            'id'=>$id,
            'data'=>$data,
            // 'pembelian'=>$pembelian
        ]);
    }
}
