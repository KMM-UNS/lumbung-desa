<?php

namespace App\Http\Controllers\Admin\DataPetani;

use App\DataTables\Admin\Penjualan\PenjualanProdukDataTable;
use App\Models\Tanaman;
use App\Models\DataPetani;
use App\Models\DataPembeli;
use App\Http\Controllers\Controller;
use App\Models\KondisiHasilPanen;
use App\Models\PenjualanProduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Models\GudangLumbung;
use App\Models\KeteranganGudang;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;


class GrafikController extends Controller
{
    public function index()
    {
        // $data = PenjualanProduk::findOrFail($id);
        $total_harga=PenjualanProduk::select(DB::raw("SUM(total) as total_harga"))
        ->GroupBy(DB::raw("Month(tgl_penjualan)"))
        ->pluck('total_harga');
// dd($total_harga);
        $bulan=PenjualanProduk::select(DB::raw("MONTHNAME(tgl_penjualan) as bulan"))
        ->GroupBy(DB::raw("MONTHNAME(tgl_penjualan)"))
        ->pluck('bulan');
        // dd($allData);
// dd($bulan);
        return view('pages.admin.data-petani.grafik.index',compact('total_harga', 'bulan'));
        // return view('pages.admin.dashboard',[
        //     'total_harga'=>$data->total_harga,
        //     'bulan'=>$data->bulan
        // ]);
    }

    // public function grafik()
    // {
    //     $data = PenjualanProduk::findOrFail($id);
    //     $total_harga=PenjualanProduk::select(DB::raw("CAST(SUM(total) as int) as total_harga"))
    //     ->GroupBy(DB::raw("MONTH(tgl_penjualan)"))
    //     ->pluck('total_harga');

    //     $bulan=PenjualanProduk::select(DB::raw("MONTHNAME(tgl_penjualan) as int) as bulan"))
    //     ->GroupBy(DB::raw("MONTHNAME(tgl_penjualan)"))
    //     ->pluck('bulan');

    //     return view('pages.admin.dashboard',compact('total_harga', 'bulan'));
    //     return view('pages.admin.dashboard',[
    //         'total_harga'=>$data->total_harga,
    //         'bulan'=>$data->bulan
    //     ]);
    // }

    // public function grafik()
    // {
    //     $penjualanproduk = PenjualanProduk::select(
    //                     DB::raw("month(tgl_penjualan) as month"),
    //                     DB::raw("SUM(total) as total_harga"))
    //                 ->orderBy(DB::raw("MONTH(tgl_penjualan)"))
    //                 ->groupBy(DB::raw("MONTH(tgl_penjualan)"))
    //                 ->get();

    //     $result[] = ['month','total_harga'];
    //     foreach ($penjualanproduk as $key => $value) {
    //         $result[++$key] = [$value->month, (int)$value->total_harga];
    //     }
    //     return view('pages.admin.data-petani.grafik.index')
    //             ->with('penjualanproduk',json_encode($result));
    // }
}
