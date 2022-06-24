<?php

namespace App\Http\Controllers\admin\pembelian;

use App\Models\Tanaman;
use App\Models\DataPetani;
use Illuminate\Http\Request;
use App\Models\DataJenisLahan;
use App\Models\PembelianModal;
use App\Models\KondisiHasilPanen;
use App\Models\PerkiraanPembelian;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PembelianModalDataTable;

class PembelianModalController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        // ERORR!! Gabisa di create data
        // $data = PerkiraanPembelian::findOrFail($id);
        // $musim_panen=PembelianModal::where('musim_panen_id',$id);
        $tanaman=Tanaman::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $petani=DataPetani::pluck('nama','id');
        $lahan=DataJenisLahan::pluck('nama','id');
        return view('pages.admin.perkiraan-pembelian.pembelian-modal.add-edit', [
            // 'data'=>$data,
            // 'musim_panen'=>$musim_panen,
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

    public function show(PembelianModalDataTable $dataTable, $id)
    {
        $modal['modal'] = PembelianModal::where('musim_panen_id', $id)->get();
        return $dataTable->render('pages.admin.perkiraan-pembelian.pembelian-modal.index', $modal, compact('id'));
    }

    public function edit(PembelianModal $pembelianModal)
    {
        //
    }

    public function update(Request $request, PembelianModal $pembelianModal)
    {
        //
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
