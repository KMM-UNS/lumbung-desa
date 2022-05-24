<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\KasDataTable;
use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\KategoriKas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KasDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorikas=KategoriKas::pluck('nama','id');
        return view('pages.admin.kas.add-edit',['kategorikas'=>$kategorikas]);
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
            Kas::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas.index'))->withToastSuccess('Data tersimpan');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function show(Kas $kas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kas::findOrFail($id);
        $kategorikas=KategoriKas::pluck('nama','id');
        return view('pages.admin.kas.add-edit', ['data' => $data, 'kategorikas'=>$kategorikas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Kas::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.kas.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Kas::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }    }
}
