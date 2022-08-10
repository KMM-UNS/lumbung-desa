<?php

namespace App\Http\Controllers\Admin\Riwayat;

use App\Models\Pembelian;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Models\PembelianPupuk;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\RiwayatPembelian\RiwayatPembelianDataTable;
use App\DataTables\Admin\RiwayatPembelian\DetailRiwayatPembelianDataTable;
use App\Models\DetailPembelianProduk;
use App\Models\KondisiHasilPanen;
use App\Models\Tanaman;

class RiwayatPembelianController extends Controller
{
    public function index(RiwayatPembelianDataTable $dataTable)
    {
        $data = DataPetani::has('petani')->get();
        // $petani=DataPetani::pluck('nama','id');
        return $dataTable->render('pages.admin.riwayat-transaksi.pembelian.index', [
        // return view('pages.admin.riwayat-transaksi.pembelian.index', [
            'data'=>$data,
            // 'petani'=>$petani
        ]);
    }

    public function show(DetailRiwayatPembelianDataTable $dataTable, $id)
    {
        // $data=Pembelian::select('petani_id')->where('petani_id', $id)->first();
        // $petani=DataPetani::select('id')->where('nama');
        // $pembelian_produk=Tanaman::where('id', $id)->get();
        // $kondisi_produk=KondisiHasilPanen::where('id', $id)->get();
        $datapetani=DataPetani::findOrFail($id);
        if($datapetani != null) {
            $pembelian=Pembelian::where('petani_id', $datapetani->id)->get();
        }else{
            $pembelian=Pembelian::where('petani_id', $datapetani)->get();
        }
        // hitung total berat produk
        $totalberatproduk = Pembelian::where('petani_id', $datapetani->id)->get();

        $totalberatproduk = DetailPembelianProduk::whereHas('pembelian',
        function($query) use ($datapetani){
            return $query->where('petani_id', $datapetani->id);
        })->get()->sum('jumlah');
        // dd($totalberatproduk);
        // $totalproduk = Pembelian::where('tanaman_id', $datapetani->id)->get()->where('kondisi_id', $kondisi_produk->id)->get()->count();
        // dd($pembelian_produk);
        // total pembelian
        $totalpembelian = DetailPembelianProduk::whereHas('pembelian',
        function($query) use ($datapetani){
            return $query->where('petani_id', $datapetani->id);
        })->get()->sum('total');
        return $dataTable->render('pages.admin.riwayat-transaksi.pembelian.show', [
        // return view('pages.admin.riwayat-transaksi.pembelian.show', [
            'id'=>$id,
            // 'data'=>$data,
            'datapetani'=>$datapetani,
            'pembelian'=>$pembelian,
            'totalberatproduk'=>$totalberatproduk,
            // 'totalproduk'=>$totalproduk,
            'totalpembelian'=>$totalpembelian,
        ]);
    }
}
