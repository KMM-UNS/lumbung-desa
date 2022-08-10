<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\Models\DataPupuk;
use App\Models\Pembelian;
use App\Models\OrderPupuk;
use App\Models\DataPenjual;
use App\Models\GudangPupuk;
use Illuminate\Http\Request;
use App\Models\PembelianPupuk;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailPembelianPupuk;
use App\DataTables\Admin\Pembelian\PembelianPupukDataTable;
use App\DataTables\Admin\Pembelian\DetailPembelianPupukDataTable;
use App\DataTables\Admin\LaporanPembelian\LaporanPembelianPupukDataTable;
use App\DataTables\Admin\LaporanPembelian\LaporanPembelianProdukDataTable;

class PembelianPupukController extends Controller
{
    public function index(PembelianPupukDataTable $dataTable)
    {
        $pembelian = Pembelian::select('no_pembelian')->groupBy('no_pembelian')->get();
        return $dataTable->render('pages.admin.pembelian-pupuk.index', [
            'pembelian' => $pembelian
        ]);
    }

    public function create()
    {
        $pupuk = DataPupuk::pluck('nama', 'id');
        $penjual = DataPenjual::pluck('instansi', 'id');
        $cart = OrderPupuk::where('status', '0')->get();
        // dd($pupuks);
        return view('pages.admin.pembelian-pupuk.add-edit', [
            'pupuk' => $pupuk,
            'penjual' => $penjual,
            'cart' => $cart
        ]);
    }

    public function addToCart(Request $request)
    {
        // melakukan pengecekan pada table order
        $product_check = OrderPupuk::where('id', $request->pupuk_order_id)->where('status', '0')->first();
        // kondisi pengecekan
        if ($product_check == null) {
            $order = new OrderPupuk();
            $order->pupuk_order_id = $request->pupuk_order_id;
            $order->jumlah = $request->jumlah;
            $order->harga = $request->harga;
        } else {
            $order = OrderPupuk::where('pupuk_order_id', $request->pupuk_order_id)->where('status', '0')->first();
            $order->pupuk_order_id = $request->pupuk_order_id;
            $order->jumlah += $request->jumlah;
        }
        $order->total += $request->harga * $request->jumlah;
        $order->save();
        // dd($order);
        return redirect()->route('admin.pembelian.pembelian-pupuk.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        DB::transaction(function () use ($request) {
            try {
                // dd($data);
                // $pupuks = PembelianPupuk::orderBy('no_pembelian', 'DESC')->first();

                // if ($pupuks) {
                //     $pecahData = explode('-', $pupuks->no_pembelian);

                //     $nomorTerakhir = (int) ltrim($pecahData[1], "0");
                //     $no_pembelian = 'LDC-' . sprintf("%08d", ($nomorTerakhir + 1));
                // } else {
                //     $no_pembelian = 'LDC-' . sprintf("%08d", 1);
                // }
                $no_pembelian = $request->no_pembelian;
                $tanggal_pembelian = $request->tanggal_pembelian;
                $penjual_id = $request->penjual_id;
                // dd($data);
                $pembelian = PembelianPupuk::create([
                    'no_pembelian' => $no_pembelian,
                    'tanggal_pembelian' => $tanggal_pembelian,
                    'penjual_id' => $penjual_id,
                    'subtotal' => $request->subtotal,
                ]);
                $pembelian->save();

                foreach ($request->order_pupuk_id as $key => $data) {
                    $detailpembelian = DetailPembelianPupuk::create([
                        'pupuk_id' => $data,
                        'pembelian_id' => $pembelian->id,
                        'jumlah' => $request->jumlah[$key],
                        'harga' => $request->harga[$key],
                        'total' => $request->total[$key],
                    ]);

                    $detailpembelian->save();
                    // menyimpan semua data pembelian yang diinputkan
                    // dd(request()->all());
                    // $pembelian_pupuk=PembelianPupuk::create($request->all());
                    // $pembelian_pupuk->save();
                    // dd($pembelian_pupuk);
                    // get data gudang yang diinputkan
                    foreach ($request->order_pupuk_id as $key => $data) {
                        $gudangPupuk = GudangPupuk::where('nama_pupuk', $data)->first();
                        // $gudangPupuk = GudangPupuk::where('nama_pupuk', $pembelian_pupuk->pupuk_id)->first();
                        // dd($gudangPupuk);
                        // percabangan untuk cek apakah data gudang sudah ada atau belum

                        if (isset($gudangPupuk)) {
                            // jika sudah maka update stok
                            $gudangPupuk->stok = $gudangPupuk->stok + $request->jumlah[$key];
                            // dd($pembelian_pupuk);
                            $gudangPupuk->save();
                        } else {
                            // foreach ($request->order_pupuk_id as $key => $data) {
                            // jika belum maka create data baru
                            $gudang2 = GudangPupuk::create([
                                'nama_pupuk' => $data,
                                'stok' => $request->jumlah[$key],
                                'keterangan' => '-',
                            ]);
                            $gudang2->save();
                        }
                    }
                }

                DB::table('order_pupuk')->delete();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something went wrong');
            }
        });

        return redirect(route('admin.pembelian.pembelian-pupuk.index'))->withToastSuccess('Data tersimpan');
    }

    public function detail(DetailPembelianPupukDataTable $dataTable, $id)
    {
        $pembelian = PembelianPupuk::where('id',$id)->get();
        $data = DetailPembelianPupuk::where('pembelian_id', $id)->get();
        return $dataTable->render('pages.admin.pembelian-pupuk.show', [
            'id' => $id,
            'data' => $data,
            'pembelian' => $pembelian
        ]);
    }

    public function edit($no_pembelian)
    {
        $data = PembelianPupuk::findOrFail($no_pembelian);
        $pupuk = DataPupuk::pluck('nama', 'id');
        $penjual = DataPenjual::pluck('instansi', 'id');
        $cart = PembelianPupuk::where('no_pembelian', $no_pembelian)->get();
        return view('pages.admin.pembelian-pupuk.add-edit', [
            'data' => $data,
            'pupuk' => $pupuk,
            'penjual' => $penjual,
            'cart' => $cart
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

    public function hapus($id)
    {
        try {
            OrderPupuk::find($id)->delete();
            return redirect((route('admin.pembelian.pembelian-pupuk.create')));
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function invoice($no_pembelian)
    {
        $pembelianPupuk = PembelianPupuk::where('no_pembelian', $no_pembelian)->get();
        $data = DetailPembelianPupuk::where('pembelian_id', $no_pembelian)->get();
        $pdf = PDF::loadview('pages.admin.pembelian-pupuk.invoice', [
            'data' => $data,
            'no_pembelian' => $no_pembelian,
            'pembelianPupuk' => $pembelianPupuk
        ]);
        return $pdf->download('invoice-pembelian-pupuk.pdf');

        // dd($pembelianPupuk);
        // return view('pages.admin.pembelian-pupuk.invoice', [
        //     'data' => $data,
        //     'no_pembelian' => $no_pembelian,
        //     'pembelianPupuk' => $pembelianPupuk
        // ]);
    }

    public function laporanpupuk(LaporanPembelianPupukDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.laporan-pembelian.pupuk.index');
    }
}
