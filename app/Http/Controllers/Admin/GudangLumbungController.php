<?php

namespace App\Http\Controllers\Admin;

use App\Models\Satuan;
use App\Models\Tanaman;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;
use App\Models\GudangLumbung;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\GudangLumbung\GudangLumbungDataTable;
use App\Http\Requests\GudangLumbungForm;
use App\Models\KondisiHasilPanen;

class GudangLumbungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GudangLumbungDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.gudang-lumbung.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenistanaman=JenisTanaman::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        return view('pages.admin.gudang-lumbung.add-edit',['jenistanaman'=>$jenistanaman, 'tanaman'=>$tanaman, 'satuan'=>$satuan,'kondisi'=>$kondisi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GudangLumbungForm $request)
    {
        try {
            GudangLumbung::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.gudang-lumbung.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GudangLumbung  $gudangLumbung
     * @return \Illuminate\Http\Response
     */
    public function show(GudangLumbung $gudangLumbung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GudangLumbung  $gudangLumbung
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = GudangLumbung::findOrFail($id);
        $jenistanaman=JenisTanaman::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        return view('pages.admin.gudang-lumbung.add-edit', ['data' => $data, 'jenistanaman'=>$jenistanaman, 'tanaman'=>$tanaman, 'satuan'=>$satuan, 'kondisi'=>$kondisi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GudangLumbung  $gudangLumbung
     * @return \Illuminate\Http\Response
     */
    public function update(GudangLumbungForm $request, $id)
    {
        try {
            $data = GudangLumbung::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.gudang-lumbung.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GudangLumbung  $gudangLumbung
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            GudangLumbung::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
