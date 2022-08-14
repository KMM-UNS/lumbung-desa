<?php

namespace App\Http\Controllers\User;

use App\Models\Pembelian;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailPembelianProduk;
use App\DataTables\User\RiwayatPenjualanDataTable;
use App\DataTables\User\DetailRiwayatPenjualanDataTable;

class RiwayatPenjualanController extends Controller
{

    public function index(RiwayatPenjualanDataTable $dataTable)
    {
        // $datapetani = DataPetani::get();
        // $riwayatpenjualan = Pembelian::where('petani_id', auth()->user()->nik);
        // // $riwayatpenjualan = Pembelian::get();
        // // return view('pages.user.riwayat-penjualan.index', ['riwayatpenjualan'=>$riwayatpenjualan]);
        // return $dataTable->render('pages.user.riwayat-penjualan.index', ['riwayatpenjualan'=>$riwayatpenjualan]);

        $data = DataPetani::has('petani')->get();
        return $dataTable->render('pages.user.riwayat-penjualan.index', [
            'data'=>$data,
        ]);
    }

    public function show(DetailRiwayatPenjualanDataTable $dataTable, $id)
    {
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
        // dd($pembelian);
        return $dataTable->render('pages.user.riwayat-penjualan.show', [
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
