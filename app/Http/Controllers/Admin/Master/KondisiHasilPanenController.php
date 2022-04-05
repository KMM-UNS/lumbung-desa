<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\KondisiHasilPanenDataTable;
use App\Http\Controllers\Controller;
use App\Models\KondisiHasilPanen;
use Illuminate\Http\Request;

class KondisiHasilPanenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KondisiHasilPanenDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.kondisi-hasil-panen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.kondisi-hasil-panen.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            try {
                $request->validate(['kondisi'=>'required|min:3']);
            } catch (\Throwable $th) {
                return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
            }

            try {
                KondisiHasilPanen::create($request->all());
            } catch (\Throwable $th) {
                return back()->withInput()->withToastError('Something went wrong');
            }

            return redirect(route('admin.master-data.kondisi-hasil-panen.index'))->withToastSuccess('Data tersimpan');
        }    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KondisiHasilPanen  $kondisiHasilPanen
     * @return \Illuminate\Http\Response
     */
    public function show(KondisiHasilPanen $kondisiHasilPanen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KondisiHasilPanen  $kondisiHasilPanen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KondisiHasilPanen::findOrFail($id);
        return view('pages.admin.master.kondisi-hasil-panen.add-edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KondisiHasilPanen  $kondisiHasilPanen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KondisiHasilPanen $id)
    {
        try {
            $request->validate([
                'kondisi' => 'required',
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = KondisiHasilPanen::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            // dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.kondisi-hasil-panen.index'))->withToastSuccess('Data tersimpan');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KondisiHasilPanen  $kondisiHasilPanen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            KondisiHasilPanen::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }    }
}
