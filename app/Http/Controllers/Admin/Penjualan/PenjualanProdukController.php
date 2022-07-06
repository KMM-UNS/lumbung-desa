<?php

namespace App\Http\Controllers\Admin\Penjualan;

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

class PenjualanProdukController extends Controller
{
    public function index(PenjualanProdukDataTable $dataTable)
    {
       return $dataTable->render('pages.admin.datapenjualan.penjualanproduk.index');
    }
    public function create()
    {
        $produk = GudangLumbung::with('tanaman:id,nama')->get()->pluck('tanaman.nama','tanaman.id');
        //tanaman nama relasi, id & nama itu yg diambil di tabel tanaman, nama itu yg menyimpan id yang diambil
        $kondisi=GudangLumbung::with('kondisi:id,nama')->get()->pluck('kondisi.nama','kondisi.id');
        $keterangan=GudangLumbung::with('keterangangudang:id,nama')->get()->pluck('keterangangudang.nama','keterangangudang.id');
        $petani=DataPetani::pluck('nama','id');
        $pembeli=DataPembeli::pluck('nama','id');
        return view('pages.admin.datapenjualan.penjualanproduk.add-edit', [
            'produk'=>$produk,
            'kondisi'=>$kondisi,
            'keterangan'=>$keterangan,
            'petani' => $petani,


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

        return view('pages.admin.datapenjualan.penjualanproduk.add-edit');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        DB::transaction(function () use ($request) {
            try {

                $penjualan=PenjualanProduk::create($request->all());
                $penjualan->save();
                // dd($penjualan);
                // get data gudang yang diinputkan
                $gudangLumbung = GudangLumbung::where('nama_tanaman_id',
                $penjualan->produk_id)->where('kondisi_id', $penjualan->kondisi)-> //produk_id itu nama kolom  di database di penjualan
                where('keterangan_id', $penjualan->keterangan)->first();
                //  dd($gudangLumbung);


                    // percabangan untuk cek apakah data gudang sudah ada atau belum
                    if(isset($gudangLumbung)){
                        $gudangLumbung->stok >= $penjualan->jumlah;
                        $gudangLumbung->stok = $gudangLumbung->stok - $penjualan->jumlah;
                        // dd($pembelian);
                        $gudangLumbung->save();
//if positif, else negatif
                    }
                    else {

                        // jika sudah maka update stok
                        $gudangLumbung->stok < $penjualan->jumlah;
                        // dd($penjualan->jumlah);
                        return back()->withInput()->withToastError('Jumlah melebihi stok yang tersedia');

                    }
                } catch (\Throwable $th) {
                    // dd($th);
                    DB::rollback();
                    return back()->withInput()->withToastError('Something went wrong');
                }
            });

            //     }

            // } catch (\Throwable $th) {
                //     dd($th);
                //     return back()->withInput()->withToastError('Something went wrong');
                // }

                return redirect(route('admin.penjualan.penjualanproduk.index'))->withToastSuccess('Data tersimpan');
            }

            public function show($id)
            {
                $data = PenjualanProduk::findOrFail($id);
                return view('pages.admin.datapenjualan.penjualanproduk.show', ['data' => $data]);
            }

            public function edit($id)
            {
                $data = PenjualanProduk::findOrFail($id);
                $pembeli=DataPembeli::pluck('nama','id');
                // $produk=GudangLumbung::pluck('nama_tanaman_id','id');
                $produk = GudangLumbung::with('tanaman:id,nama')->get()->pluck('tanaman.nama','tanaman.id');
                $kondisi=GudangLumbung::pluck('kondisi_id','id');
                $keterangan=GudangLumbung::pluck('keterangan_id','id');
                // $kondisihasilpanen=KondisiHasilPanen::pluck('kondisi', 'id');
                return view('pages.admin.datapenjualan.penjualanproduk.add-edit', [
                'data' => $data,
                'produk'=>$produk,
                'kondisi'=>$kondisi,
                'keterangan'=>$keterangan,
                'pembeli'=>$pembeli
            ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = PenjualanProduk::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }


        return redirect(route('admin.penjualan.penjualanproduk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            PenjualanProduk::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }


    public function invoice($id)
    {
        $data = PenjualanProduk::findOrFail($id);


        $pdf = PDF::loadview('pages.admin.datapenjualan.penjualanproduk.invoice',

        [

        'no_penjualan'=>$data->no_penjualan,
        'tgl_penjualan'=>$data->tgl_penjualan,
        'nama'=>$data->nama,
        'email'=>$data->email,
        'no_hp'=>$data->no_hp,
        'alamat'=>$data->alamat,
        'jumlah'=>$data->jumlah,
        'harga'=>$data->harga,
       // 'kondisi'=>$data->kondisi,
        'produk'=>$data->produk,
        'total'=>$data->total
        ]);
        return $pdf->download('invoice.pdf');
        // return view('pages.admin.penjualan.invoice', ['data' => $data]);
    }

}
