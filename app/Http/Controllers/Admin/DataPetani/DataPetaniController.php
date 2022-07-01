<?php

namespace App\Http\Controllers\Admin\DataPetani;

use App\DataTables\Admin\DataPetani\DataPetaniDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataPetaniForm;
use App\Models\DataPetani;

use Illuminate\Http\Request;



class DataPetaniController extends Controller
{
    public function index(DataPetaniDataTable $dataTable)
    {
       return $dataTable->render('pages.admin.data-petani.petani.index');

    }

   // public function upload(Request $request){
      //  if($request->hasFile('foto')){
        //   $resorce       = $request->file('foto');
          //  $filename   = $resorce->getClientOriginalName();
            //$resorce->move(\base_path() ."public/storage/images", $filename);
            //$save = DataPetani::table('images')->insert(['foto' => $filename]);
            //echo "Gambar berhasil di upload";
        //}else{
          // echo "Gagal upload gambar";
       // }
    //}
    public function create()
    {
        return view('pages.admin.data-petani.petani.add-edit');
    }

    // public function store(DataPetani $request)
    public function store(Request $request)
    {
        try {
 $request->validate([
            // 'unique' => ':data sudah ada',
            // 'filename' => 'image|file|max:1024',
            'no_kk' => 'unique:data_petanis,no_kk',
            'nik' => 'unique:data_petanis,nik',
        ]);

        } catch (\Throwable $th) {

            return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        }

        try {
            DataPetani::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.data-petani.petani.index'))->withToastSuccess('Data tersimpan');
    }

    public function edit($id)
    {
        $data = DataPetani::findOrFail($id);
        return view('pages.admin.data-petani.petani.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    // public function update(Request $request, $id)
    {
        // try {
        //     $request->validate([
        //         // 'nama' => 'required'
        //     ]);
        // } catch (\Throwable $th) {
        //     return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
        // }
        try {
            $request->validate([
                       // 'unique' => ':data sudah ada',
                       // 'filename' => 'image|file|max:1024',
                       'no_kk' => 'unique:data_petanis,no_kk',
                       'nik' => 'unique:data_petanis,nik',
                   ]);

                   } catch (\Throwable $th) {

                       return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
                   }

        try {
            $data = DataPetani::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }


        return redirect(route('admin.data-petani.petani.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            DataPetani::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }
    public function show($id)
    {
        $data = DataPetani::findOrFail($id);
        return view('pages.admin.data-petani.petani.show', ['data' => $data]);
    }

}
