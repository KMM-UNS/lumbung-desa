<?php

namespace App\Http\Controllers\User;

use App\DataTables\User\RiwayatPenjualanDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataPetani;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class RiwayatPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RiwayatPenjualanDataTable $dataTable)
    {
        $datapetani = DataPetani::get();
        $riwayatpenjualan = Pembelian::where('user_id', auth()->user()->id);
        // $riwayatpenjualan = Pembelian::get();
        // return view('pages.user.riwayat-penjualan.index', ['riwayatpenjualan'=>$riwayatpenjualan]);
        return $dataTable->render('pages.user.riwayat-penjualan.index', ['riwayatpenjualan'=>$riwayatpenjualan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
