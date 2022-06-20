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
use App\Models\KeteranganGudang;
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
        $tanaman=Tanaman::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $keterangangudang=KeteranganGudang::pluck('nama','id');
        return view('pages.admin.gudang-lumbung.add-edit',[
            'tanaman'=>$tanaman,
            'satuan'=>$satuan,
            'kondisi'=>$kondisi,
            'keterangangudang'=>$keterangangudang
        ]);
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
            // get data gudang yang di inputkan
            $gudangLumbung = GudangLumbung::where('nama_tanaman_id', $request->nama_tanaman_id)->where('kondisi_id', $request->kondisi_id)->where('keterangan_id', $request->keterangan_id)->first();
            // dd($gudangLumbung);

            // percabangan untuk cek apakah data gudang sudah ada atau belum
            if(isset($gudangLumbung)){
                // jika sudah maka update stok
                $gudangLumbung->stok = $gudangLumbung->stok + $request->stok;
                $gudangLumbung->save();
            }
            else {
                // jika belum maka create data baru
                GudangLumbung::create($request->all());
            }

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
        // $satuan=Satuan::pluck('satuan','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $keterangangudang=KeteranganGudang::pluck('nama','id');
        return view('pages.admin.gudang-lumbung.add-edit', [
            'data' => $data,
            'jenistanaman'=>$jenistanaman,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            'keterangangudang'=>$keterangangudang
        ]);
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
