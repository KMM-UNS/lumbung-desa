<?php

namespace App\Http\Controllers\Admin\DataPetani;

use App\DataTables\Admin\DataPetani\DataLahanDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataJenisLahan;
use App\Models\DataLahan;
use App\Models\DataPetani;
use Illuminate\Http\Request;

class DataLahanController extends Controller
{
    public function index(DataLahanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.data-petani.datalahan.index');
    }
    public function create()
    {
        $namapetani=DataPetani::pluck('nama','id');
        $jenislahan=DataJenisLahan::pluck('nama', 'id');
        return view('pages.admin.data-petani.datalahan.add-edit',['namapetani' => $namapetani, 'jenislahan' => $jenislahan]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            DataLahan::create($request->all());
        } catch (\Throwable $th)
         {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.data-petani.datalahan.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = DataLahan::findOrFail($id);
        $namapetani=DataPetani::pluck('nama','id');
        $jenislahan=DataJenisLahan::pluck('nama','id');
        return view('pages.admin.data-petani.datalahan.add-edit', ['data' => $data, 'namapetani' => $namapetani, 'jenislahan' => $jenislahan]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([

            ]);
        } catch (\Throwable $th) {
            //dd($th);
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = DataLahan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.data-petani.datalahan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            DataLahan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
