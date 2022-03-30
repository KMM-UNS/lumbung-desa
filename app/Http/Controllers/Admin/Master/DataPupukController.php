<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\DataPupukDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataPupuk;
use Illuminate\Http\Request;

class DataPupukController extends Controller
{
    public function index(DataPupukDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.datapupuk.index');
    }
    public function create()
    {
        return view('pages.admin.master.datapupuk.add-edit');
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
            DataPupuk::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.datapupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = DataPupuk::findOrFail($id);
        return view('pages.admin.master.datapupuk.add-edit', ['data' => $data]);
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
            $data = DataPupuk::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.datapupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            DataPupuk::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
