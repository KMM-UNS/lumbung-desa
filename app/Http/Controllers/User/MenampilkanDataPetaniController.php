<?php

namespace App\Http\Controllers\User;
//use Illuminate\Support\Facades\DB;

use App\DataTables\User\menampilkandatapetaniDataTable;

//use App\DataTables\MenampilkanDataPetaniDataTable;
use App\Http\Controllers\Controller;

use App\Models\DataPetani;

use Illuminate\Http\Request;


class MenampilkanDataPetaniController extends Controller
{

    public function index()
    {
    //   //  $petani = DataPetani::where('createable_id', auth()->user()->id)->first();
    //    return $dataTable->render('pages.user.menampilkandatapetani.index');//,['petani'=> $petani]);
    $datapetani = DataPetani::get();
    return view('pages.user.menampilkandatapetani.show',['datapetani'=>$datapetani]);
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
        return view('pages.user.menampilkandatapetani.add-edit');
    }

    public function store(Request $request)
    {
    //     DB::transaction(function () use ($request) {
    //         try {
    //             // dd($request->all());
    //             $datapetani = DataPetani::create($request->all());
    //             //$datapetani->createable()->associate($request->user());
    //             $datapetani->save();

    //             // dd($dataanak);
    //         } catch (\Throwable $th) {
    //             DB::rollBack();
    //             dd($th);
    //             return back()->withInput()->withToastError('Something went wrong');
    //         }
    // });
    //     //return $request->file('filename')->store('public/post-images');
    //     // try {
    //     //     $request->validate([
    //     //      //   'filename',
    //     //        // 'filename.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'
    //     //     ]);
    //     //    // if ($request->hasfile('filename')) {
    //     //      //   $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('filename')->getClientOriginalName());
    //     //        // $request->file('filename')->move(public_path('images'), $filename);
    //     //          //DataPetani::create(
    //     //            //     [
    //     //              //       'foto' =>$filename
    //     //                // ]
    //     //             //);
    //     //       //  echo'Success';
    //     //     //}else{
    //     //       //  echo'Gagal';
    //     //    // }


    //     // } catch (\Throwable $th) {

    //     //     return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
    //     // }

    //     try {
    //         DataPetani::create($request->all());
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         return back()->withInput()->withToastError('Something went wrong');
    //     }

    //     return redirect(route('user.menampilkandatapetani.index'))->withToastSuccess('Data tersimpan');
     }

    public function edit($id)
    {
       // $data = DataPetani::findOrFail($id);
        //return view('pages.user.menampilkandatapetani.add-edit', ['data' => $data]);
    }

    public function update(Request $request, $id) //kalo mau c
    {
    //     try {
    //         $request->validate([
    //             'nama' => 'required'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError($th->validator->messages()->all()[0]);
    //     }

    //     try {
    //         $data = DataPetani::findOrFail($id);
    //         $data->update($request->all());
    //     } catch (\Throwable $th) {
    //         return back()->withInput()->withToastError('Something went wrong');
    //     }


    //     return redirect(route('user.menampilkandatapetani.index'))->withToastSuccess('Data tersimpan');
    // }

    //public function destroy($id)
    //{
      //  try {
        //    DataPetani::find($id)->delete();
        //} catch (\Throwable $th) {
          //  return response(['error' => 'Something went wrong']);
        //}
    }
    public function show($id)
    {
       $datapetani = DataPetani::findOrFail($id);
        return view('pages.user.menampilkandatapetani.show', ['data' => $datapetani]);
    }


}
