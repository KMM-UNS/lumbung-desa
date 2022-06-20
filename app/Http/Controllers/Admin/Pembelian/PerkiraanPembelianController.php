<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\Models\Musim;
use App\Models\Tanaman;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Models\DataJenisLahan;
use App\Models\KondisiHasilPanen;
use App\Models\PerkiraanPembelian;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PembelianModalDataTable;
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
        return view('pages.admin.perkiraan-pembelian.add-edit');
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

        return redirect(route('admin.pembelian.perkiraan-pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerkiraanPembelian  $perkiraanPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(PembelianModalDataTable $dataTable,$id)
    {
        $data = PerkiraanPembelian::findOrFail($id);
        return $dataTable->render('pages.admin.perkiraan-pembelian.show', ['data'=>$data]);
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
        return view('pages.admin.perkiraan-pembelian.add-edit', ['data'=>$data]);
    }

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
