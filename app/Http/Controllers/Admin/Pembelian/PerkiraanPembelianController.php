<?php

namespace App\Http\Controllers\Admin\Pembelian;

use Illuminate\Http\Request;
use App\Models\PerkiraanPembelian;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PembelianModalDataTable;
use App\DataTables\Admin\Pembelian\PerkiraanPembelianDataTable;
use App\Models\PembelianModal;

class PerkiraanPembelianController extends Controller
{
    public function index(PerkiraanPembelianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.perkiraan-pembelian.index');
    }

    public function create()
    {
        return view('pages.admin.perkiraan-pembelian.add-edit');
    }

    public function store(Request $request)
    {
        try {
            PerkiraanPembelian::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.perkiraan-pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    // public function show(PembelianModalDataTable $dataTable,$id)
    // {
    //     $data = PembelianModal::where('musim_panen_id', $id);
    //     return $dataTable->render('pages.admin.perkiraan-pembelian.show', ['data'=>$data]);
    // }

    public function edit($id)
    {
        $data = PerkiraanPembelian::findOrFail($id);
        return view('pages.admin.perkiraan-pembelian.add-edit', ['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = PerkiraanPembelian::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.perkiraan-pembelian.index'))->withToastSuccess('Data tersimpan');    }

    public function destroy($id)
    {
        try {
            PerkiraanPembelian::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
