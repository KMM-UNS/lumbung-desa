<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\KasDataTable;
use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\KategoriKas;
use App\Models\KategoriPembayaran;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index(KasDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas.index');
    }

    public function create()
    {
        $kategorikas=KategoriKas::pluck('nama','id');
        $kategoripembayaran=KategoriPembayaran::pluck('nama','id');
        return view('pages.admin.kas.add-edit',[
            'kategorikas'=>$kategorikas,
            'kategoripembayaran'=>$kategoripembayaran
        ]);
    }

    public function store(Request $request)
    {
        try {
            Kas::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas.index'))->withToastSuccess('Data tersimpan');    }

    public function edit($id)
    {
        $data = Kas::findOrFail($id);
        $kategorikas=KategoriKas::pluck('nama','id');
        $kategoripembayaran=KategoriPembayaran::pluck('nama','id');
        return view('pages.admin.kas.add-edit', [
            'data' => $data,
            'kategorikas'=>$kategorikas,
            'kategoripembayaran'=>$kategoripembayaran
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Kas::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Kas::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }    }
}
