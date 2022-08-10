<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\GudangPupuk;
use Illuminate\Http\Request;
use App\Models\GudangLumbung;
use Illuminate\Support\Facades\DB;
use App\Charts\PerbandinganHargaChart;
use App\Models\DetailPembelianProduk;
use App\Models\DetailPembelianPupuk;
use App\Models\PembelianPupuk;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PerbandinganHargaChart $perbandinganHargaChart)
    {
        $data = Pembelian::all();
        $total_produk = GudangLumbung::count();
        $total_pupuk = GudangPupuk::count();
        $total_pembelian_produk = Pembelian::count();
        $total_pembelian_pupuk = PembelianPupuk::count();
        $total_pengeluaran_pembelian_produk = DetailPembelianProduk::sum('total');
        $total_pengeluaran_pembelian_pupuk = DetailPembelianPupuk::sum('total');
        if(auth()->user()->hasRole('user_petani')){
            return view('home');
        }
        else {
            // dd($total_pengeluaran_pembelian);
            return view('pages.admin.dashboard', [
                'data' => $data,
                'total_produk' => $total_produk,
                'total_pupuk' => $total_pupuk,
                'total_pembelian_produk' => $total_pembelian_produk,
                'total_pembelian_pupuk' => $total_pembelian_pupuk,
                'total_pengeluaran_pembelian_produk' => $total_pengeluaran_pembelian_produk,
                'total_pengeluaran_pembelian_pupuk' => $total_pengeluaran_pembelian_pupuk,
                // 'perbandinganHargaChart' => $perbandinganHargaChart->build()
            ]);
        }
    }
}
