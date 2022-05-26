<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\KeteranganGudangDataTable;
use App\Http\Controllers\Controller;
use App\Models\KeteranganGudang;
use Illuminate\Http\Request;

class KeteranganGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KeteranganGudangDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.keterangan-gudang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.keterangan-gudang.add-edit');
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
            KeteranganGudang::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }
        return redirect(route('admin.master-data.keterangan-gudang.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeteranganGudang  $keteranganGudang
     * @return \Illuminate\Http\Response
     */
    public function show(KeteranganGudang $keteranganGudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeteranganGudang  $keteranganGudang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KeteranganGudang::findOrFail($id);
        return view('pages.admin.master.keterangan-gudang.add-edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeteranganGudang  $keteranganGudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = KeteranganGudang::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.kategori-kas.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeteranganGudang  $keteranganGudang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            KeteranganGudang::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
