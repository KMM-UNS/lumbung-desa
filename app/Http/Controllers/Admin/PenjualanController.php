<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PenjualanDataTable;
use App\Http\Controllers\Controller;

use App\Models\Penjualan;

use Illuminate\Http\Request;


class PenjualanController extends Controller
{
    public function index(PenjualanDataTable $dataTable)
    {
       return $dataTable->render('pages.admin.penjualan.index');
    }
    public function create()
    {
        return view('pages.admin.penjualan.add-edit');
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
            Penjualan::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.penjualan.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Penjualan::findOrFail($id);
        return view('pages.admin.penjualan.add-edit', ['data' => $data]);
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
            $data = Penjualan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }


        return redirect(route('admin.penjualan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Penjualan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function detail($id)
    {

    }

}
