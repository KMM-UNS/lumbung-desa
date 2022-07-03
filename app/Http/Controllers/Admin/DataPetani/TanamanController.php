<?php

namespace App\Http\Controllers\Admin\DataPetani;

use App\Datatables\Admin\DataPetani\TanamanDataTable;
use App\Http\Controllers\Controller;
use App\Models\JenisTanaman;
use App\Models\Tanaman;
use App\Models\DataPupuk;
use App\Models\Musim;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    public function index(TanamanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.data-petani.tanaman.index');
    }
    public function create()
    {
        $jenistanaman=JenisTanaman::pluck('nama','id');
        $pupuk=DataPupuk::pluck('nama','id');
        $musimtanam=Musim::pluck('nama','id');
        return view('pages.admin.data-petani.tanaman.add-edit',['jenistanaman'=>$jenistanaman, 'pupuk'=>$pupuk, 'musimtanam'=>$musimtanam]);
    }

    public function store(Request $request)
    {
        // try {
        //     $request->validate(['nama'=>'required']);
        // } catch (\Throwable $th) {
        //     return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        // }

        try {
            Tanaman::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.data-petani.tanaman.index'))->withToastSuccess('Data tersimpan');
    }

    public function simpan(Request $request)
    {
        try {
            Tanaman::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect()->back()->with('Data tersimpan');
    }

    public function show(Tanaman $tanaman)
    {
        //
    }

    public function edit($id)
    {
        $data = Tanaman::findOrFail($id);
        // dd($data);
        $jenistanaman=JenisTanaman::pluck('nama','id');
        $pupuk=DataPupuk::pluck('nama','id');
        $musimtanam=Musim::pluck('nama','id');
        return view('pages.admin.data-petani.tanaman.add-edit', ['data' => $data, 'jenistanaman'=>$jenistanaman, 'pupuk'=>$pupuk, 'musimtanam'=>$musimtanam]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Tanaman::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }
        // dd($th);
        return redirect(route('admin.data-petani.tanaman.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Tanaman::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
