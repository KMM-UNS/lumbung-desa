<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\DataJenisLahanDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataJenisLahan;
use Illuminate\Http\Request;

class DataJenisLahanController extends Controller
{
    public function index(DataJenisLahanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.datajenislahan.index');
    }
    public function create()
    {
        return view('pages.admin.master.datajenislahan.add-edit');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            DataJenisLahan::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.datajenislahan.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = DataJenisLahan::findOrFail($id);
        return view('pages.admin.master.datajenislahan.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = DataJenisLahan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.datajenislahan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            DataJenisLahan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
