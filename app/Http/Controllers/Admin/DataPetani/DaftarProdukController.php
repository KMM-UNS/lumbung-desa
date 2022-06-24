<?php

namespace App\Http\Controllers\Admin\DataPetani;

use App\DataTables\Admin\DataPetani\DaftarProdukDataTable;
use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use App\Models\KeteranganGudang;
use App\Models\KondisiHasilPanen;
use Illuminate\Http\Request;

class DaftarProdukController extends Controller
{
    public function index(DaftarProdukDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.data-petani.daftarproduk.index');
    }
    public function create()
    {
        // $produk = GudangLumbung::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $keterangan=KeteranganGudang::pluck('nama','id');
        return view('pages.admin.data-petani.daftarproduk.add-edit', [
        // 'produk'=>$produk,
        'kondisi'=>$kondisi,
        'keterangan'=>$keterangan,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            DaftarProduk::create($request->all());
        } catch (\Throwable $th)

         {dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.data-petani.daftarproduk.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {

       // $produk = GudangLumbung::pluck('nama','id');
        $kondisi=KondisiHasilPanen::pluck('nama','id');
        $keterangan=KeteranganGudang::pluck('keterangan_id','id');
        return view('pages.admin.data-petani.daftarproduk.add-edit', [
       // 'produk'=>$produk,
        'kondisi'=>$kondisi,
        'keterangan'=>$keterangan,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([

            ]);
        } catch (\Throwable $th) {
            //dd($th);
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = DaftarProduk::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.data-petani.daftarproduk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            DaftarProduk::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
