<?php

namespace App\Http\Controllers\Admin\Master;

use App\Datatables\Admin\Master\JenisTanamanDataTable;
use App\Http\Controllers\Controller;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;

class JenisTanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JenisTanamanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.jenistanaman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.jenistanaman.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJenisTanamanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate(['nama'=>'required|min:3']);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            JenisTanaman::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.jenistanaman.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisTanaman  $jenisTanaman
     * @return \Illuminate\Http\Response
     */
    public function show(JenisTanaman $jenisTanaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisTanaman  $jenisTanaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = JenisTanaman::findOrFail($id);
        return view('pages.admin.master.jenistanaman.add-edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJenisTanamanRequest  $request
     * @param  \App\Models\JenisTanaman  $jenisTanaman
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|min:3'
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = JenisTanaman::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.jenistanaman.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisTanaman  $jenisTanaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            JenisTanaman::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
