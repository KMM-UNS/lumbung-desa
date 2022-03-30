<?php

namespace App\Http\Controllers\Admin\Master;

use App\DataTables\Admin\Master\MusimDataTable;
use App\Http\Controllers\Controller;
use App\Models\Musim;
use Illuminate\Http\Request;

class MusimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MusimDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.Musim.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.master.Musim.add-edit');
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
            $request->validate(['nama'=>'required|min:3']);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            Musim::create($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.musim.index'))->withToastSuccess('Data tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Musim  $musim
     * @return \Illuminate\Http\Response
     */
    public function show(Musim $musim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Musim  $musim
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Musim::findOrFail($id);
        return view('pages.admin.master.musim.add-edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Musim  $musim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|min:3',
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            $data = Musim::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.master-data.musim.index'))->withToastSuccess('Data tersimpan');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Musim  $musim
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Musim::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
}
