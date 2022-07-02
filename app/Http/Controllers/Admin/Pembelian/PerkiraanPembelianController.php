<?php

namespace App\Http\Controllers\Admin\Pembelian;

use Illuminate\Http\Request;
use App\Models\PerkiraanPembelian;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PembelianModalDataTable;
use App\DataTables\Admin\Pembelian\PerkiraanPembelianDataTable;
use App\Models\DataPetani;
use App\Models\PembelianModal;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class PerkiraanPembelianController extends Controller
{
    public function index(PerkiraanPembelianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.perkiraan-pembelian.index');
    }

    public function create()
    {
        return view('pages.admin.perkiraan-pembelian.add-edit');
    }

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

    public function show(PembelianModalDataTable $dataTable, $id)
    {
        $musim = PembelianModal::select('musim_panen_id')->where('musim_panen_id', $id)->first();
        $data = PerkiraanPembelian::findOrFail($id);
        // hitung jumlah petani
        $jumlahpetani = PembelianModal::where('musim_panen_id', $data->id)->get()->count();
        // hitung total berat produk
        $totalberatproduk = PembelianModal::sum('jumlah',$data->id); // jumlahnya masih belum bisa get per id
        // dd($totalberatproduk);
        // Hitung Perkiraan Modal
        $perkiraanmodal = PembelianModal::sum('total', $data->id);
        // Hitung Total Jumlah Produk
        return $dataTable->render('pages.admin.perkiraan-pembelian.show', [
            'id' => $id,
            'musim' => $musim,
            'jumlahpetani' => $jumlahpetani,
            'totalberatproduk'=>$totalberatproduk,
            'perkiraanmodal'=>$perkiraanmodal,
        ]);
    }

    public function edit($id)
    {
        $data = PerkiraanPembelian::findOrFail($id);
        return view('pages.admin.perkiraan-pembelian.add-edit', [
            'data'=>$data
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = PerkiraanPembelian::findOrFail($id);
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
            PerkiraanPembelian::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
