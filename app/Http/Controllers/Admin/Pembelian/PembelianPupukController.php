<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\Models\DataPupuk;
use App\Models\GudangPupuk;
use Illuminate\Http\Request;
use App\Models\PembelianPupuk;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PembelianPupukDataTable;

class PembelianPupukController extends Controller
{
    public function index(PembelianPupukDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.pembelian-pupuk.index');
    }

    public function create()
    {
        $pupuk = DataPupuk::pluck('nama','id');
        return view('pages.admin.pembelian-pupuk.add-edit', [
            'pupuk'=>$pupuk
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            try {
                // menyimpan semua data pembelian yang diinputkan
                $pembelian_pupuk=PembelianPupuk::create($request->all());
                $pembelian_pupuk->save();
                // get data gudang yang diinputkan
                $gudangPupuk = GudangPupuk::where('nama_pupuk', $pembelian_pupuk->pupuk_id)->first();
                // dd($gudangPupuk);
                // percabangan untuk cek apakah data gudang sudah ada atau belum
                if(isset($gudangPupuk)){
                    // jika sudah maka update stok
                    $gudangPupuk->stok = $gudangPupuk->stok + $pembelian_pupuk->jumlah;
                    // dd($pembelian_pupuk);
                    $gudangPupuk->save();
                }
                else {
                    // jika belum maka create data baru
                    $gudang2 = GudangPupuk::create([
                        'nama_pupuk' => $pembelian_pupuk->pupuk_id,
                        'stok'=>$pembelian_pupuk->jumlah,
                        'keterangan' => '-',
                    ]);
                    $gudang2->save();
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something went wrong');
            }
        });

        return redirect(route('admin.pembelian.pembelian-pupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function show(PembelianPupuk $pembelianPupuk)
    {
        //
    }

    public function edit($id)
    {
        $data = PembelianPupuk::findOrFail($id);
        $pupuk = DataPupuk::pluck('nama','id');
        return view('pages.admin.pembelian-pupuk.add-edit', [
            'data'=>$data,
            'pupuk'=>$pupuk
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = PembelianPupuk::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.pembelian-pupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            PembelianPupuk::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}