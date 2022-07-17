<?php

namespace App\Http\Controllers;

use App\Charts\PerbandinganHargaChart;
use App\Models\GudangLumbung;
use App\Models\GudangPupuk;
use Illuminate\Http\Request;

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
        if(auth()->user()->hasRole('user_petani')){
            return view('home');
        }
        else {
            return view('pages.admin.dashboard', [
                'total_produk' => $total_produk,
                'total_pupuk' => $total_pupuk,
                'perbandinganHargaChart' => $perbandinganHargaChart->build()
            ]);
        }
    }
}
