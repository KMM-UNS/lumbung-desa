<?php

namespace App\Http\Controllers\Admin\Riwayat;

use App\Models\Penjualan;
use App\Models\DataPembeli;
use Illuminate\Http\Request;
use App\Models\PenjualanPpk;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\RiwayatPenjualan\RiwayatPenjualanPupukDataTable;
use App\DataTables\Admin\RiwayatPenjualan\DetailRiwayatPenjualanPupukDataTable;

class RiwayatPenjualanPupukController extends Controller
{
    public function index(RiwayatPenjualanPupukDataTable $dataTable)
    {
        // $data = DataPembeli::has('pembeli')->get();
        return $dataTable->render('pages.admin.riwayat-transaksi.riwayatpenjualanpupuk.index', [
        // return view('pages.admin.riwayat-transaksi.pembelian.index', [
            // 'data'=>$data
        ]);
    }

    public function show(DetailRiwayatPenjualanPupukDataTable $dataTable, $id)
    {
        // $data = DataPetani::findOrFail($id);
        // $pembelian = Pembelian::get();
        // $data['data'] = Pembelian::where('petani_id', $id)->get();
        $data=PenjualanPpk::select('nama_pembeli')->where('nama_pembeli', $id);
        // $datapembeli=DataPembeli::findOrFail($id);
        // dd($id);
        return $dataTable->render('pages.admin.riwayat-transaksi.riwayatpenjualanpupuk.show', [
        // return view('pages.admin.riwayat-transaksi.pembelian.show', [
            'id'=>$id,
            'data'=>$data,
            // 'pembelian'=>$pembelian
        ]);
    }
}