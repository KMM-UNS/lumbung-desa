<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\Models\Musim;
use App\Models\Satuan;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use App\Models\KondisiHasilPanen;
use App\Models\PerkiraanPembelian;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PerkiraanPembelianDataTable;

class PerkiraanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PerkiraanPembelianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.perkiraan-pembelian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $musim=Musim::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        return view('pages.admin.perkiraan-pembelian.add-edit', ['musim'=>$musim, 'tanaman'=>$tanaman, 'kondisi'=>$kondisi, 'satuan'=>$satuan]);
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
            PerkiraanPembelian::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.perkiraan-pembelian.index'))->withToastSuccess('Data tersimpan');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerkiraanPembelian  $perkiraanPembelian
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PerkiraanPembelian::findOrFail($id);
        $musim=Musim::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        return view('pages.admin.perkiraan-pembelian.show', ['data' => $data, 'musim'=>$musim, 'tanaman'=>$tanaman, 'kondisi'=>$kondisi, 'satuan'=>$satuan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerkiraanPembelian  $perkiraanPembelian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PerkiraanPembelian::findOrFail($id);
        $musim=Musim::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        return view('pages.admin.perkiraan-pembelian.add-edit', ['data' => $data, 'musim'=>$musim, 'tanaman'=>$tanaman, 'kondisi'=>$kondisi, 'satuan'=>$satuan]);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerkiraanPembelian  $perkiraanPembelian
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerkiraanPembelian  $perkiraanPembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            PerkiraanPembelian::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }    }
}
