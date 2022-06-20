<?php

namespace App\Http\Controllers\admin\pembelian;

use App\Models\Tanaman;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Models\DataJenisLahan;
use App\Models\PembelianModal;
use App\Models\KondisiHasilPanen;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PerkiraanPembelianDataTable;
use App\Models\PerkiraanPembelian;

class PembelianModalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PerkiraanPembelianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.perkiraan-pembelian.pembelian-modal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = PerkiraanPembelian::findOrFail($id);
        $musim_panen=PerkiraanPembelian::pluck('musim_panen','id');
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $petani=DataPetani::pluck('nama','id');
        $lahan=DataJenisLahan::pluck('nama','id');
        return view('pages.admin.perkiraan-pembelian.pembelian-modal.add-edit', compact('id'), [
            'data'=>$data,
            'musim_panen'=>$musim_panen,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            'petani'=>$petani,
            'lahan'=>$lahan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        try {
            PembelianModal::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }
        // PembelianModal::create([
        //     'musim_panen_id' => $request->musim_panen_id,
        //     'tanaman_id' => $request->tanaman_id,
        //     'petani_id' => $request->petani_id,
        //     'lahan_id' => $request->lahan_id,
        //     'luas_lahan' => $request->luas_lahan,
        //     'jumlah' => $request->jumlah,
        //     'kondisi_id' => $request->kondisi_id,
        //     'harga' => $request->harga,
        //     'total' => $request->total
        // ])->compact($id);

        return redirect(route('pages.admin.perkiraan-pembelian.pembelian-modal.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembelianModal  $pembelianModal
     * @return \Illuminate\Http\Response
     */
    public function show(PembelianModal $pembelianModal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembelianModal  $pembelianModal
     * @return \Illuminate\Http\Response
     */
    public function edit(PembelianModal $pembelianModal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembelianModal  $pembelianModal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembelianModal $pembelianModal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembelianModal  $pembelianModal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            PembelianModal::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
