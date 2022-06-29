<?php

namespace App\Http\Controllers\Admin\GudangLumbung;

use App\Models\GudangPupuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\GudangLumbung\GudangPupukDataTable;
use App\Models\DataPupuk;

class GudangPupukController extends Controller
{
    public function index(GudangPupukDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.gudang-pupuk.index');
    }

    public function create()
    {
        $pupuk = DataPupuk::pluck('nama','id');
        return view('pages.admin.gudang-pupuk.add-edit', [
            'pupuk'=>$pupuk,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // get data gudang yang di inputkan
            $gudangPupuk = GudangPupuk::where('nama_pupuk', $request->nama_pupuk)->first();
            // dd($gudangPupuk);

            // percabangan untuk cek apakah data gudang sudah ada atau belum
            if(isset($gudangPupuk)){
                // jika sudah maka update stok
                $gudangPupuk->stok = $gudangPupuk->stok + $request->stok;
                $gudangPupuk->save();
            }
            else {
                // jika belum maka create data baru
                GudangPupuk::create($request->all());
            }

        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.gudang-lumbung.gudang-pupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = GudangPupuk::findOrFail($id);
        $pupuk = DataPupuk::pluck('nama','id');
        return view('pages.admin.gudang-pupuk.add-edit', [
            'data' => $data,
            'pupuk' => $pupuk
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = GudangPupuk::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.gudang-lumbung.gudang-pupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            GudangPupuk::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
