<?php

namespace App\Http\Controllers\Admin\GudangLumbung;

use App\Models\Musim;
use App\Models\Satuan;
use App\Models\Tanaman;
use App\Models\DataPupuk;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;
use App\Models\GudangLumbung;
use App\Models\KeteranganGudang;
use App\Models\KondisiHasilPanen;
use App\Http\Controllers\Controller;
use App\Http\Requests\GudangLumbungForm;
use App\DataTables\Admin\GudangLumbung\GudangLumbungDataTable;

class GudangLumbungController extends Controller
{
    public function index(GudangLumbungDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.gudang-lumbung.index');
    }

    public function create()
    {
        $tanaman=Tanaman::pluck('nama','id');
        $satuan=Satuan::pluck('satuan','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $keterangangudang=KeteranganGudang::pluck('nama','id');
         // relasi modal (pop up tambah produk)
         $jenistanaman=JenisTanaman::pluck('nama','id');
         $musimtanam=Musim::pluck('nama','id');
         $pupuk=DataPupuk::pluck('nama','id');
        return view('pages.admin.gudang-lumbung.add-edit',[
            'tanaman'=>$tanaman,
            'satuan'=>$satuan,
            'kondisi'=>$kondisi,
            'keterangangudang'=>$keterangangudang,
            'jenistanaman'=>$jenistanaman,
            'musimtanam'=>$musimtanam,
            'pupuk'=>$pupuk
        ]);
    }

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

        return redirect(route('admin.gudang-lumbung.gudang-produk.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = GudangLumbung::findOrFail($id);
        $jenistanaman=JenisTanaman::pluck('nama','id');
        $tanaman=Tanaman::pluck('nama','id');
        // $satuan=Satuan::pluck('satuan','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $keterangangudang=KeteranganGudang::pluck('nama','id');
        // Relasi modal tanaman
        $musimtanam=Musim::pluck('nama','id');
        $pupuk=DataPupuk::pluck('nama','id');
        return view('pages.admin.gudang-lumbung.add-edit', [
            'data' => $data,
            'jenistanaman'=>$jenistanaman,
            'tanaman'=>$tanaman,
            'kondisi'=>$kondisi,
            'keterangangudang'=>$keterangangudang,
            'musimtanam'=>$musimtanam,
            'pupuk'=>$pupuk
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = GudangLumbung::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.gudang-lumbung.gudang-produk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            GudangLumbung::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
