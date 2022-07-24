<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\Models\DataPupuk;
use App\Models\GudangPupuk;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\PembelianPupuk;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Pembelian\PembelianPupukDataTable;
use App\Models\DataPenjual;
use App\Models\Pembelian;

class PembelianPupukController extends Controller
{
    public function index(PembelianPupukDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.pembelian-pupuk.index');
    }

    public function create()
    {
        // $cartItems = \Cart::getContent();
        $pupuk = DataPupuk::pluck('nama','id');
        $penjual = DataPenjual::pluck('instansi','id');
        // $cart = PembelianPupuk::where('status', '0')->get();
        return view('pages.admin.pembelian-pupuk.add-edit', [
            'pupuk'=>$pupuk,
            'penjual'=>$penjual,
            // 'cartItems'=>$cartItems
            // 'cart'=>$cart
        ]);
    }

    // public function addToCart(Request $request)
    // {
    //     \Cart::add([
    //         'no_pembelian' => $request->no_pembelian,
    //         'tanggal_pembelian' => $request->tanggal_pembelian,
    //         'pupuk_id' => $request->pupuk_id,
    //         'jumlah' => $request->jumlah,
    //         'harga' => $request->harga,
    //         'total' => $request->total
    //     ]);
    //     session()->flash('success', 'Produk Berhasil Ditambahkan !');

    //     return redirect()->with('Data tersimpan');

    //     melakukan pengecekan pada table order
    //     $product_check = PembelianPupuk::where('id', $request->pupuk_id)->where('status','0')->first();
    //     // kondisi pengecekan
    //     if($product_check == null) {
    //         $order = new PembelianPupuk();
    //         $order->pupuk_id = $request->pupuk_id;
    //         $order->jumlah = $request->jumlah;
    //         $order->harga = $request->harga;
    //     } else {
    //         $order = PembelianPupuk::where('pupuk_id', $request->pupuk_id)->where('status','0')->first();
    //         $order->pupuk_id = $request->pupuk_id;
    //         $order->jumlah += $request->jumlah;
    //     }
    //     $order->total += $request->harga * $request->jumlah;
    //     $order->tanggal_pembelian = $request->tanggal_pembelian;
    //     $order->penjual_id = $request->penjual_id;
    //     $order->save();
    //     // dd($order);
    //     return redirect()->route('admin.pembelian.pembelian-pupuk.create');
    // }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            try {
                // \Cart::add([
                //     'no_pembelian' => $request->no_pembelian,
                //     'tanggal_pembelian' => $request->tanggal_pembelian,
                //     'id' => $request->id,
                //     'name' => $request->pupuk_id,
                //     'quantity' => $request->jumlah,
                //     'price' => $request->harga,
                //     'total' => $request->total
                // ]);
                // session()->flash('success', 'Produk Berhasil Ditambahkan !');

                // // melakukan pengecekan pada table order
                // $product_check = PembelianPupuk::where('id', $request->pupuk_id)->first();
                // //kondisi pengecekan
                // if($product_check == null) {
                //     $order = new PembelianPupuk();
                //     $order->pupuk_id = $request->pupuk_id;
                //     $order->jumlah = $request->jumlah;
                //     $order->harga = $request->harga;
                // } else {
                //     $order = PembelianPupuk::where('pupuk_id', $request->pupuk_id)->first();
                //     $order->pupuk_id = $request->pupuk_id;
                //     $order->jumlah += $request->jumlah;
                // }
                // $order->total = $request->harga * $request->jumlah;
                // $order->tanggal_pembelian = $request->tanggal_pembelian;
                // $order->penjual_id = $request->penjual_id;
                // // $order->save();
                // // dd($order);
                // // return redirect()->route('admin.pembelian.pembelian-pupuk.create');

                // menyimpan semua data pembelian yang diinputkan
                $pembelian_pupuk=PembelianPupuk::create($request->all()); // get data pembelian dgn status 0
                $pembelian_pupuk->save(); // ubah ststus 0 jadi 1
                // get data gudang yang diinputkan
                $gudangPupuk = GudangPupuk::where('nama_pupuk', $pembelian_pupuk->pupuk_id)->first();
                // dd($gudangPupuk);
                // percabangan untuk cek apakah data gudang sudah ada atau belum
                if(isset($gudangPupuk)){
                    // jika sudah maka update stok
                    $gudangPupuk->stok = $gudangPupuk->stok + $pembelian_pupuk->jumlah;
                    // dd($pembelian_pupuk);
                    $gudangPupuk->save();
                }
                else {
                    // jika belum maka create data baru
                    $gudang2 = GudangPupuk::create([
                        'nama_pupuk' => $pembelian_pupuk->pupuk_id,
                        'stok'=>$pembelian_pupuk->jumlah,
                        'keterangan' => '-',
                    ]);
                    $gudang2->save();
                }
            } catch (\Throwable $th) {
                // dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something went wrong');
            }
        });
        // return redirect()->route('admin.pembelian.pembelian-pupuk.create');

        return redirect(route('admin.pembelian.pembelian-pupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function show(PembelianPupuk $pembelianPupuk)
    {
        //
    }

    public function edit($id)
    {
        $data = PembelianPupuk::findOrFail($id);
        $pupuk = DataPupuk::pluck('nama','id');
        $penjual = DataPenjual::pluck('instansi', 'id');
        $cart = PembelianPupuk::where('status', '0')->get();
        return view('pages.admin.pembelian-pupuk.add-edit', [
            'data'=>$data,
            'pupuk'=>$pupuk,
            'penjual'=>$penjual,
            'cart'=>$cart
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = PembelianPupuk::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.pembelian-pupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            PembelianPupuk::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function invoice($id)
    {
        $data = PembelianPupuk::findOrFail($id);
        $pdf = PDF::loadview('pages.admin.pembelian-pupuk.invoice', [
            'pupuk_id'=>$data->pupuk->nama,
            'no_pembelian'=>$data->no_pembelian,
            'tanggal_pembelian'=>$data->tanggal_pembelian,
            'jumlah'=>$data->jumlah,
            'harga'=>$data->harga,
            'total'=>$data->total
        ]);
        return $pdf->download('invoice-pembelian-pupuk.pdf');
        // return view('pages.admin.pembelian-pupuk.invoice', [
        //     'data' => $data,
        //     'pupuk_id'=>$data->pupuk->nama,
        //     'no_pembelian'=>$data->no_pembelian,
        //     'tanggal_pembelian'=>$data->tanggal_pembelian,
        //     'jumlah'=>$data->jumlah,
        //     'harga'=>$data->harga,
        //     'total'=>$data->total
        // ]);
    }

    public function newinvoice()
    {
        $data = PembelianPupuk::where('status', '0')->get();
        $pdf = PDF::loadview('pages.admin.pembelian-pupuk.inv', [
            'pupuk_id'=>$data->pupuk->nama,
            'no_pembelian'=>$data->no_pembelian,
            'tanggal_pembelian'=>$data->tanggal_pembelian,
            'jumlah'=>$data->jumlah,
            'harga'=>$data->harga,
            'total'=>$data->total
        ]);
        // return $pdf->download('invoice-pembelian-pupuk.pdf');
        return view('pages.admin.pembelian-pupuk.inv', [
            'data' => $data,
            'pupuk_id'=>$data->pupuk->nama,
            'no_pembelian'=>$data->no_pembelian,
            'tanggal_pembelian'=>$data->tanggal_pembelian,
            'jumlah'=>$data->jumlah,
            'harga'=>$data->harga,
            'total'=>$data->total
        ]);
    }
}
