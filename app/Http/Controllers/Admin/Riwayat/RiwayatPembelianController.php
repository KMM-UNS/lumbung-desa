<?php

namespace App\Http\Controllers\Admin\Riwayat;

use App\Models\Pembelian;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Models\PembelianPupuk;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\RiwayatPembelian\RiwayatPembelianDataTable;
use App\DataTables\Admin\RiwayatPembelian\DetailRiwayatPembelianDataTable;

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
        $data=Pembelian::select('petani_id')->where('petani_id', $id)->first();
        $datapetani=DataPetani::findOrFail($id);
        // hitung total berat produk
        $totalberatproduk = Pembelian::where('petani_id', $datapetani->id)->get()->sum('jumlah',$datapetani->id);
        // dd($data);
        return $dataTable->render('pages.admin.riwayat-transaksi.pembelian.show', [
        // return view('pages.admin.riwayat-transaksi.pembelian.show', [
            'id'=>$id,
            'data'=>$data,
            'totalberatproduk'=>$totalberatproduk,
        ]);
    }
}
