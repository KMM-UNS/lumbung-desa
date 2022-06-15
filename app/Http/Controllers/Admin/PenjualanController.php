<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PenjualanDataTable;
use App\Http\Controllers\Controller;
use App\Models\KondisiHasilPanen;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;



class PenjualanController extends Controller
{
    public function index(PenjualanDataTable $dataTable)
    {
       return $dataTable->render('pages.admin.penjualan.index');
    }
    public function create()
    {
        $kondisihasilpanen=KondisiHasilPanen::pluck('kondisi', 'id');
        return view('pages.admin.penjualan.add-edit',['kondisihasilpanen' => $kondisihasilpanen]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            Penjualan::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.penjualan.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = Penjualan::findOrFail($id);
        $kondisihasilpanen=KondisiHasilPanen::pluck('kondisi', 'id');
        return view('pages.admin.penjualan.add-edit', ['data' => $data, 'kondisihasilpanen' => $kondisihasilpanen]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = Penjualan::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }


        return redirect(route('admin.penjualan.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Penjualan::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function show($id)
    {
        $data = Penjualan::findOrFail($id);
        return view('pages.admin.penjualan.show', ['data' => $data]);
    }

    public function invoice($id)
    {
        $data = Penjualan::findOrFail($id);


        $pdf = PDF::loadview('pages.admin.penjualan.invoice',

        [

        'no_penjualan'=>$data->no_penjualan,
        'tgl_penjualan'=>$data->tgl_penjualan,
        'nama'=>$data->nama,
        'email'=>$data->email,
        'no_hp'=>$data->no_hp,
        'alamat'=>$data->alamat,
        'jumlah'=>$data->jumlah,
        'harga'=>$data->harga,
       // 'kondisi'=>$data->kondisi,
        'produk'=>$data->produk,
        'total'=>$data->total
        ]);
        return $pdf->download('invoice.pdf');
        // return view('pages.admin.penjualan.invoice', ['data' => $data]);
    }

}
