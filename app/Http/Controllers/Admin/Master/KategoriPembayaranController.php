<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\KategoriPembayaranDataTable;
use App\Http\Controllers\Controller;
use App\Models\KategoriPembayaran;
use Illuminate\Http\Request;

class KategoriPembayaranController extends Controller
{
    public function index(KategoriPembayaranDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.kategori-pembayaran.index');
    }

    public function create()
    {
        return view('pages.admin.master.kategori-pembayaran.add-edit');
    }

    public function store(Request $request)
    {
        try {
            KategoriPembayaran::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }
        return redirect(route('admin.master-data.kategori-pembayaran.index'))->withToastSuccess('Data tersimpan');    }

    public function edit($id)
    {
        $data = KategoriPembayaran::findOrFail($id);
        return view('pages.admin.master.kategori-pembayaran.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = KategoriPembayaran::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.kategori-pembayaran.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            KategoriPembayaran::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
