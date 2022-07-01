<?php

namespace App\Http\Controllers\Admin\Penjualan;

use App\DataTables\Admin\Penjualan\PenjualanPupukDataTable;
use App\Models\Tanaman;
use App\Models\DataPetani;
use App\Http\Controllers\Controller;
use App\Models\KondisiHasilPanen;
use App\Models\PenjualanPupuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Models\GudangLumbung;
use App\Models\KeteranganGudang;

class PenjualanPupukController extends Controller
{
    public function index(PenjualanPupukDataTable $dataTable)
    {
       return $dataTable->render('pages.admin.datapenjualan.penjualanpupuk.index');
    }
    public function create()
    {
        $produk = GudangLumbung::with('tanaman:id,nama')->get()->pluck('tanaman.nama','tanaman.id');//tanaman nama relasi, id sama nama itu yg diambil di dalam tabel tanaman, terus nama tanaman itu nama relasi, dan nama itu yg menyimpan yang diambil
        $kondisi=GudangLumbung::with('kondisi:id,nama')->get()->pluck('kondisi.nama','kondisi.id');
        $keterangan=GudangLumbung::with('keterangangudang:id,nama')->get()->pluck('keterangangudang.nama','keterangangudang.id');
        $petani=DataPetani::pluck('nama','id');
        return view('pages.admin.penjualan.penjualanpupuk.add-edit', [
            'produk'=>$produk,
            'kondisi'=>$kondisi,
            'keterangan'=>$keterangan,
            'petani' => $petani
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

        return view('pages.admin.datapenjualan.penjualanpupuk.add-edit');
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

                $penjualan=PenjualanPupuk::create($request->all());
                $penjualan->save();
                dd($penjualan);
                // get data gudang yang diinputkan
                $gudangLumbung = GudangLumbung::where('nama_tanaman_id',
                $penjualan->produk)->where('kondisi_id', $penjualan->kondisi)->
                where('keterangan_id', $penjualan->keterangan)->first();
                //  dd($gudangLumbung);
                // if($request->jumlah >= $gudangLumbung->stok){
                    //     return back()->withInput()->withToastError('Jumlah stok melebihi batas');
                    // }

                    // percabangan untuk cek apakah data gudang sudah ada atau belum
                    if(isset($gudangLumbung)){

                        // jika sudah maka update stok
                        $gudangLumbung->stok = $gudangLumbung->stok - $penjualan->jumlah;
                        // dd($pembelian);
                        $gudangLumbung->save();
                    }
                    else {
                        //jika belum maka create data baru

                        $gudang = GudangLumbung::create([
                            'nama_tanaman_id' => $penjualan->produk,
                            'stok'=>$penjualan->jumlah,
                            'kondisi_id' => $penjualan->kondisi,
                            'keterangan_id' => $penjualan->keterangan,
                        ]);
                        $gudang->save();

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

                return redirect(route('admin.penjualan.penjualanpupuk.index'))->withToastSuccess('Data tersimpan');
            }

            public function show($id)
            {
                $data = PenjualanPupuk::findOrFail($id);
                return view('pages.admin.datapenjualan.penjualanpupuk.show', ['data' => $data]);
            }

            public function edit($id)
            {
                $data = PenjualanPupuk::findOrFail($id);
                $produk=GudangLumbung::pluck('nama_tanaman_id','id');
                $kondisi=GudangLumbung::pluck('kondisi_id','id');
        $keterangan=GudangLumbung::pluck('keterangan_id','id');
        // $kondisihasilpanen=KondisiHasilPanen::pluck('kondisi', 'id');
        return view('pages.admin.datapenjualan.penjualanpupuk.add-edit', [
            'data' => $data,
            'produk'=>$produk,
            'kondisi'=>$kondisi,
            'keterangan'=>$keterangan
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
            $data = PenjualanPupuk::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }


        return redirect(route('admin.penjualan.penjualanpupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            PenjualanPupuk::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }


    public function invoice($id)
    {
        $data = PenjualanPupuk::findOrFail($id);


        $pdf = PDF::loadview('pages.admin.datapenjualan.penjualanpupuk.invoice',

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
