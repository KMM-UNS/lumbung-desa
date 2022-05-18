<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\KategoriKasDataTable;
use App\Http\Controllers\Controller;
use App\Models\KategoriKas;
use Illuminate\Http\Request;

class KategoriKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KategoriKasDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.kategori-kas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.kategori-kas.add-edit');
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
            KategoriKas::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }
        return redirect(route('admin.master-data.kategori-kas.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriKas  $kategoriKas
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriKas $kategoriKas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriKas  $kategoriKas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KategoriKas::findOrFail($id);
        return view('pages.admin.master.kategori-kas.add-edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriKas  $kategoriKas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = KategoriKas::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.kategori-kas.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriKas  $kategoriKas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            KategoriKas::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
