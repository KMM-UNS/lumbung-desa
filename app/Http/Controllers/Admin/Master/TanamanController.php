<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\TanamanDataTable;
use App\Http\Controllers\Controller;
use App\Models\JenisTanaman;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TanamanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.tanaman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenistanaman=JenisTanaman::pluck('nama','id');
        return view('pages.admin.master.tanaman.add-edit',['jenistanaman'=>$jenistanaman]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate(['nama'=>'required|min:3']);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            Tanaman::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.tanaman.index'))->withToastSuccess('Data tersimpan');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanaman  $tanaman
     * @return \Illuminate\Http\Response
     */
    public function show(Tanaman $tanaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanaman  $tanaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Tanaman::findOrFail($id);
        // dd($data);
        $jenistanaman=JenisTanaman::pluck('nama','id');
        return view('pages.admin.master.tanaman.add-edit', ['data' => $data, 'jenistanaman'=>$jenistanaman]);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tanaman  $tanaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tanaman $id)
    {
        try {
            $request->validate([
                'jenis_tanaman_id' => 'required|min:3',
                'nama' => 'required|min:3',
                'masa_tanam' => 'required|min:3',
                'keterangan' => 'required|min:3',
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = Tanaman::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.jenistanaman.index'))->withToastSuccess('Data tersimpan');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanaman  $tanaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanaman $id)
    {
        try {
            Tanaman::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
