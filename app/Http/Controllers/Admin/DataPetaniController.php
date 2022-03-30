<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DataPetaniDataTable;
use App\Http\Controllers\Controller;

use App\Models\DataPetani;

use Illuminate\Http\Request;


class DataPetaniController extends Controller
{
    public function index(DataPetaniDataTable $dataTable)
    {
       return $dataTable->render('pages.admin.datapetani.index');
    }
    public function create()
    {
        return view('pages.admin.datapetani.add-edit');
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

        try {
            DataPetani::create($request->all());
        } catch (\Throwable $th) {
            
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.datapetani.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = DataPetani::findOrFail($id);
        return view('pages.admin.datapetani.add-edit', ['data' => $data]);
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
            $data = DataPetani::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }
        

        return redirect(route('admin.datapetani.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            DataPetani::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

}
