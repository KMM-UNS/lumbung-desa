<?php

namespace App\Http\Controllers\admin\pembelian;

use App\Models\Tanaman;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Models\DataJenisLahan;
use App\Models\PembelianModal;
use App\Models\KondisiHasilPanen;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PembelianModalDataTable;

class PembelianModalController extends Controller
{
    public function simpan($id)
    {
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $petani=DataPetani::pluck('nama','id');
        $lahan=DataJenisLahan::pluck('nama','id');
        return view('pages.admin.perkiraan-pembelian.pembelian-modal.add-edit', [
            'id'=>$id,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            'petani'=>$petani,
            'lahan'=>$lahan
        ]);
    }

    public function store(Request $request)
    {
        try {
            PembelianModal::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }
        return redirect(route('admin.pembelian.perkiraan-pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    public function show(PembelianModalDataTable $dataTable, $id)
    {
        $modal['modal'] = PembelianModal::where('musim_panen_id', $id)->get();
        return $dataTable->render('pages.admin.perkiraan-pembelian.pembelian-modal.index', $modal, compact('id'));
    }

    public function edit($id)
    {
        $data = PembelianModal::findOrFail($id);
        // $musim = PembelianModal::select('musim_panen_id')->where('musim_panen_id', $id)->first();
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $petani=DataPetani::pluck('nama','id');
        $lahan=DataJenisLahan::pluck('nama','id');
        return view('pages.admin.perkiraan-pembelian.pembelian-modal.add-edit', [
            'id'=>$id,
            // 'musim'=>$musim,
            'data'=>$data,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            'petani'=>$petani,
            'lahan'=>$lahan
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = PembelianModal::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.perkiraan-pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            PembelianModal::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
