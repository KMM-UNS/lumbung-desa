<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\GudangPupuk;
use Illuminate\Http\Request;
use App\Models\GudangLumbung;
use Illuminate\Support\Facades\DB;
use App\Charts\PerbandinganHargaChart;
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
        $total_produk = GudangLumbung::count();
        $total_pupuk = GudangPupuk::count();
        $total_pembelian_produk = Pembelian::count();
        $total_pembelian_pupuk = PembelianPupuk::count();
        if(auth()->user()->hasRole('user_petani')){
            return view('home');
        }
        else {
            // dd($jummlah);
            return view('pages.admin.dashboard', [
                'total_produk' => $total_produk,
                'total_pupuk' => $total_pupuk,
                'total_pembelian_produk' => $total_pembelian_produk,
                'total_pembelian_pupuk' => $total_pembelian_pupuk,
                'perbandinganHargaChart' => $perbandinganHargaChart->build()
            ]);
        }
    }
}
