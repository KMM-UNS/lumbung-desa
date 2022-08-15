<?php

namespace App\Http\Controllers\Admin\Penjualan;

use App\DataTables\Admin\Penjualan\PenjualanPuksDataTable;
use App\Models\Tanaman;
use App\Models\DataPetani;
use App\Models\DataPembeli;
use App\Http\Controllers\Controller;
use App\Models\KondisiHasilPanen;
use App\Models\PenjualanPuks;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Models\GudangLumbung;
use App\Models\GudangPupuk;
use App\Models\KeteranganGudang;

class PenjualanPuksController extends Controller
{
    public function index(PenjualanPuksDataTable $dataTable)
    {
       return $dataTable->render('pages.admin.datapenjualan.penjualanpuks.index');
    }
    public function create()
    {
        $produkppk = GudangPupuk::with('puks:id,nama')->get()->pluck('puks.nama','puks.id');
        //tanaman nama relasi, id & nama itu yg diambil di tabel tanaman, nama itu yg menyimpan id yang diambil
        // $kondisi=GudangLumbung::with('kondisi:id,nama')->get()->pluck('kondisi.nama','kondisi.id');
        // $keterangan=GudangLumbung::with('keterangangudang:id,nama')->get()->pluck('keterangangudang.nama','keterangangudang.id');
        // $petani=DataPetani::pluck('nama','id');
        $pembeli=DataPembeli::pluck('nama','id');
        return view('pages.admin.datapenjualan.penjualanpuks.add-edit', [
            'produkppk'=>$produkppk,
            // 'kondisi'=>$kondisi,
            // 'keterangan'=>$keterangan,
            // 'petani' => $petani,
            'pembeli'=>$pembeli


        ]);
        // $no_penjualan = Penjualan::create([
        //     'tgl_penjualan' => '',
        // 'nama' => '',
        // 'email' => '',
        // 'no_hp' => '',
        // 'alamat' => '',
        // 'produk' => '',
        // 'harga' => '',
        // 'jumlah' => '',
        // 'total' => '',
        //     ]);
// echo $no_penjualan->no_penjualan;
        // $totals = count($total);
        // for($i=0; $i<$totals; $i++){

            // mysqli_query( "insert into penjualans set
            //     no_penjualan    = '$no_penjualan[$i]',
            //     tgl_penjualan      = '$tgl_penjualan[$i]',
            //     nama  = '$nama[$i]',
            //     email = '$email[$i]',
            //     no_hp = '$no_hp[$i]',
            //     alamat = '$alamat[$i]',
            //     jumlah = '$jumlah[$i]',
            //     harga = '$harga[$i]',
            // ");

        // $kondisihasilpanen=KondisiHasilPanen::pluck('kondisi', 'id');

        return view('pages.admin.datapenjualan.penjualanpuks.add-edit');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                // 'nama' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        DB::transaction(function () use ($request) {
            try {

                $penjualan=PenjualanPuks::create($request->all());
                $penjualan->save();
                // dd($penjualan);
                // get data gudang yang diinputkan
                $gudangLumbung = GudangPupuk::where('nama_pupuk',
                $penjualan->produk_puks)->first();
                //  dd($gudangLumbung);


                    // percabangan untuk cek apakah data gudang sudah ada atau belum
//                     if(isset($gudangLumbung)){
//                         $gudangLumbung->stok >= $penjualan->jumlah;
//                         $gudangLumbung->stok = $gudangLumbung->stok - $penjualan->jumlah;
//                         // dd($pembelian);
//                         $gudangLumbung->save();
// //if positif, else negatif
//                     }
//                     else {

//                         // jika sudah maka update stok
//                         $gudangLumbung->stok < $penjualan->jumlah;
//                         // dd($penjualan->jumlah);
//                         return back()->withInput()->withToastError('Jumlah melebihi stok yang tersedia');

//                     }

if($gudangLumbung->stok>0 && $gudangLumbung->stok >=$penjualan->jumlah)

{
    $gudangLumbung->stok = $gudangLumbung->stok - $penjualan->jumlah;
    //                         // dd($penjualan);
    $gudangLumbung->save();
    // dd($gudangLumbung);
} else {
    DB::rollback();
    return back()->withInput()->withToastError('Jumlah melebihi stok yang tersedia');
}
                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollback();
                    return back()->withInput()->withToastError('Something went wrong');
                }
            });

            //     }

            // } catch (\Throwable $th) {
                //     dd($th);
                //     return back()->withInput()->withToastError('Something went wrong');
                // }

                return redirect(route('admin.penjualan.penjualanpuks.index'))->withToastSuccess('Data tersimpan');
            }

            public function show($id)
            {
                $data = PenjualanPuks::findOrFail($id);
                $produkppk = GudangPupuk::with('puks:id,nama')->get()->pluck('puks.nama','ppk.id');

        //tanaman nama relasi, id & nama itu yg diambil di tabel tanaman, nama itu yg menyimpan id yang diambil
        // $kondisi=GudangLumbung::with('kondisi:id,nama')->get()->pluck('kondisi.nama','kondisi.id');
        // $keterangan=GudangLumbung::with('keterangangudang:id,nama')->get()->pluck('keterangangudang.nama','keterangangudang.id');
        // $petani=DataPetani::pluck('nama','id');
        $pembeli=DataPembeli::pluck('nama','id');
                return view('pages.admin.datapenjualan.penjualanpuks.show', [
                    'data' => $data,
                    'produkppk'=>$produkppk,
            // 'kondisi'=>$kondisi,
            // 'keterangan'=>$keterangan,
            // 'petani' => $petani,
            'pembeli'=>$pembeli
                ]);
            }

            public function edit($id)
            {
                $data = PenjualanPuks::findOrFail($id);
                $pembeli=DataPembeli::pluck('nama','id');
                // $produk=GudangLumbung::pluck('nama_tanaman_id','id');
                $produkppk = GudangPupuk::with('puks:id,nama')->get()->pluck('puks.nama','puks.id');
        //         $kondisi=GudangLumbung::with('kondisi:id,nama')->get()->pluck('kondisi.nama','kondisi.id');
        // $keterangan=GudangLumbung::with('keterangangudang:id,nama')->get()->pluck('keterangangudang.nama','keterangangudang.id');

                // $kondisihasilpanen=KondisiHasilPanen::pluck('kondisi', 'id');
                return view('pages.admin.datapenjualan.penjualanpuks.add-edit', [
                'data' => $data,
                'produkppk'=>$produkppk,
                // 'kondisi'=>$kondisi,
                // 'keterangan'=>$keterangan,
                'pembeli'=>$pembeli
            ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                // 'nama' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = PenjualanPuks::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }


        return redirect(route('admin.penjualan.penjualanpuks.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            PenjualanPuks::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }


    public function invoice($id)
    {
        $data = PenjualanPuks::findOrFail($id);


        $pdf = PDF::loadview('pages.admin.datapenjualan.penjualanpuks.invoice',

        [

        'no_penjualan'=>$data->no_penjualan,
        'tgl_penjualan'=>$data->tgl_penjualan,
        'namapembelipuks'=>$data->pembelipuks->nama,
        'email'=>$data->email,
        'no_hp'=>$data->no_hp,
        'alamat'=>$data->alamat,
        'jumlah'=>$data->jumlah,
        'harga'=>$data->harga,
       // 'kondisi'=>$data->kondisi,
        'produk'=>$data->produkppk->ppk->nama,
        'total'=>$data->total
        ]);
        return $pdf->download('invoice.pdf');
        // return view('pages.admin.penjualan.invoice', ['data' => $data]);
    }

    public function grafikppk()
    {
         // $data = PenjualanProduk::findOrFail($id);
         $total_harga=PenjualanPuks::select(DB::raw("SUM(total) as total_harga"))
         ->GroupBy(DB::raw("Month(tgl_penjualan)"))
         ->pluck('total_harga')->toArray();
    // dd($total_harga);
         $bulan=PenjualanPuks::select(DB::raw("MONTHNAME(tgl_penjualan) as bulan"))
         ->GroupBy(DB::raw("MONTHNAME(tgl_penjualan)"))
         ->pluck('bulan')->toArray();

         $all = DB::table('penjualan_puks')->select('*')->whereNull('deleted_at')->get()->toArray();
    // dd($bulan);
         return view('pages.admin.data-petani.grafikpuks.index',compact('total_harga', 'bulan', 'all'));
        // return view('pages.admin.dashboard',compact('total_harga', 'bulan'));
    }
}
