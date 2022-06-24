<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\Models\Musim;
use App\Models\Satuan;
use App\Models\Tanaman;
use App\Models\Pembelian;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\KondisiHasilPanen;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PembelianForm;
use App\Datatables\Admin\Pembelian\PembelianDataTable;
use App\Models\GudangLumbung;

class PembelianController extends Controller
{
    public function index(PembelianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.pembelian.index');
    }

    public function create()
    {
        $musim=Musim::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        // $satuan=Satuan::pluck('satuan','id');
        $petani=DataPetani::pluck('nama','id');
        return view('pages.admin.pembelian.add-edit', [
            'musim'=>$musim,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            'petani'=>$petani
        ]);
    }

    public function store(PembelianForm $request)
    {
        DB::transaction(function () use ($request) {
            try {
                // menyimpan semua data pembelian yang diinputkan
                $pembelian=Pembelian::create($request->all());
                $pembelian->save();
                // get data gudang yang diinputkan
                $gudangLumbung = GudangLumbung::where('nama_tanaman_id', $pembelian->tanaman_id)->
                where('kondisi_id', $pembelian->kondisi_id)->where('keterangan_id', '1')->first();
                // dd($gudangLumbung);
                // percabangan untuk cek apakah data gudang sudah ada atau belum
                if(isset($gudangLumbung)){
                    // jika sudah maka update stok
                    $gudangLumbung->stok = $gudangLumbung->stok + $pembelian->jumlah;
                    // dd($pembelian);
                    $gudangLumbung->save();
                }
                else {
                    // jika belum maka create data baru

                    $gudang = GudangLumbung::create([
                        'nama_tanaman_id' => $pembelian->tanaman_id,
                        'kondisi_id' => $pembelian->kondisi_id,
                        'stok'=>$pembelian->jumlah,
                        'keterangan_id' => '1',
                    ]);
                    $gudang->save();
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something went wrong');
            }
        });

        return redirect(route('admin.pembelian.pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    public function show($id)
    {
        $data = Pembelian::findOrFail($id);
        $musim=Musim::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        $petani=DataPetani::pluck('nama','id');
        return view('pages.admin.pembelian.show', [
            'data' => $data,
            'musim'=>$musim,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            'satuan'=>$satuan,
            'petani'=>$petani
        ]);
    }

    public function edit($id)
    {
        $data = Pembelian::findOrFail($id);
        $musim=Musim::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        // $satuan=Satuan::pluck('satuan','id');
        $petani=DataPetani::pluck('nama','id');
        return view('pages.admin.pembelian.add-edit', [
            'data' => $data,
            'musim'=>$musim,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            // 'satuan'=>$satuan,
            'petani'=>$petani
        ]);
    }

    public function update(PembelianForm $request, $id)
    {
        // try {
        //     $request->validate([
        //         'tanaman_id' => 'required',
        //     ]);
        // } catch (\Throwable $th) {
        //     return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        // }

        try {
            $data = Pembelian::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Pembelian::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function invoice($id)
    {
        $data = Pembelian::findOrFail($id);
        $pdf = PDF::loadview('pages.admin.pembelian.invoice', [
            'tanaman_id'=>$data->tanaman->nama,
            'petani_id'=>$data->petani_id,
            'no_pembelian'=>$data->no_pembelian,
            'tanggal_pembelian'=>$data->tanggal_pembelian,
            'jumlah'=>$data->jumlah,
            'kondisi_id'=>$data->kondisi_id,
            'harga'=>$data->harga,
            'total'=>$data->total
        ]);
        return $pdf->download('invoice.pdf');
        // return view('pages.admin.pembelian.invoice', ['data' => $data]);
    }
}
