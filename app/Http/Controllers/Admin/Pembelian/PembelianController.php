<?php

namespace App\Http\Controllers\Admin\Pembelian;

use App\DataTables\Admin\LaporanPembelian\LaporanPembelianProdukDataTable;
use App\Models\Musim;
use App\Models\Satuan;
use App\Models\Tanaman;
use App\Models\DataPupuk;
use App\Models\Pembelian;
use App\Models\DataPetani;
use App\Models\OrderProduk;
use Illuminate\Support\Str;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;
use App\Models\GudangLumbung;
use Barryvdh\DomPDF\Facade\PDF;
use Dflydev\DotAccessData\Data;
use App\Models\KondisiHasilPanen;
use App\Models\PerkiraanPembelian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PembelianForm;
use App\Models\DetailPembelianProduk;
use App\Datatables\Admin\Pembelian\PembelianDataTable;
use App\DataTables\Admin\Pembelian\DetailPembelianProdukDataTable;

class PembelianController extends Controller
{
    public function index(PembelianDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.pembelian.index');
    }

    public function create()
    {
        $musim = PerkiraanPembelian::get()->mapWithKeys(function($i) {
            return [$i->id => $i->musim_panen.' - '.$i->tahun];
        });
        // $musim =PerkiraanPembelian::pluck('musim_panen','id');
        $petani = DataPetani::pluck('nama', 'id');
        $tanaman = Tanaman::pluck('nama', 'id');
        $kondisi = KondisiHasilPanen::pluck('nama', 'id');
        // relasi modal (pop up tambah produk)
        $jenistanaman = JenisTanaman::pluck('nama', 'id');
        $musimtanam = Musim::pluck('nama', 'id');
        $pupuk = DataPupuk::pluck('nama', 'id');
        // cart
        $cart = OrderProduk::get();
        return view('pages.admin.pembelian.add-edit', [
            'musim' => $musim,
            'tanaman' => $tanaman,
            'kondisi' => $kondisi,
            'petani' => $petani,
            'jenistanaman' => $jenistanaman,
            'musimtanam' => $musimtanam,
            'pupuk' => $pupuk,
            'cart' => $cart
        ]);
    }

    public function addToCart(Request $request)
    {
        // melakukan pengecekan pada table order
        $product_check = OrderProduk::where('id', $request->tanaman_id)->where('kondisi_id', $request->kondisi_id)->first();
        // kondisi pengecekan
        if ($product_check == null) {
            $order = new OrderProduk();
            $order->tanaman_id = $request->tanaman_id;
            $order->kondisi_id = $request->kondisi_id;
            $order->jumlah = $request->jumlah;
            $order->harga = $request->harga;
        } else {
            $order = OrderProduk::where('tanaman_id', $request->tanaman_id)->where('kondisi_id', $request->kondisi_id)->first();
            $order->tanaman_id = $request->tanaman_id;
            $order->kondisi_id = $request->kondisi_id;
            $order->jumlah += $request->jumlah;
        }
        $order->total += $request->harga * $request->jumlah;
        $order->save();
        // dd($order);
        return redirect()->route('admin.pembelian.pembelian.create');
    }

    public function store(PembelianForm $request)
    {
        // dd(request()->all());
        DB::transaction(function () use ($request) {
            try {
                $produk = Pembelian::orderBy('no_pembelian', 'DESC')->first();

                // if ($produk) {
                //     $pecahData = explode('-', $produk->no_pembelian);

                //     $nomorTerakhir = (int) ltrim($pecahData[1], "0");
                //     $no_pembelian = 'LDC-' . sprintf("%08d", ($nomorTerakhir + 1));
                // } else {
                //     $no_pembelian = 'LDC-' . sprintf("%08d", 1);
                // }
                $no_pembelian = $request->no_pembelian;
                $tanggal_pembelian =  $request->tanggal_pembelian;
                $musim = $request->musim_id;
                $petani_penjual = $request->petani_id;
                $pembelian = Pembelian::create([
                    'no_pembelian' => $no_pembelian,
                    'musim_id' => $musim,
                    'tanggal_pembelian' => $tanggal_pembelian,
                    'petani_id' => $petani_penjual,
                    'subtotal' => $request->subtotal
                ]);
                $pembelian->save();
                foreach ($request->order_produk_id as $key => $data) {
                    $detailpembelian = DetailPembelianProduk::create([
                        'pembelian_id' => $pembelian->id,
                        'tanaman_id' => $data,
                        'kondisi_id' => $request->kondisi_id[$key],
                        'jumlah' => $request->jumlah[$key],
                        'harga' => $request->harga[$key],
                        'total' => $request->total[$key]
                    ]);
                    $detailpembelian->save();

                    // menyimpan semua data pembelian yang diinputkan
                    // $pembelian=Pembelian::create($request->all());
                    // $pembelian->save();
                    // get data gudang yang diinputkan
                    foreach ($request->order_produk_id as $key => $data) {
                        $gudangLumbung = GudangLumbung::where('nama_tanaman_id', $data)->where('kondisi_id', $request->kondisi_id[$key])->where('keterangan_id', '1')->first();
                        // $gudangLumbung = GudangLumbung::where('nama_tanaman_id', $pembelian->tanaman_id)->where('kondisi_id', $pembelian->kondisi_id)->where('keterangan_id', '1')->first();
                        // dd($gudangLumbung);
                        // percabangan untuk cek apakah data gudang sudah ada atau belum
                        if (isset($gudangLumbung)) {
                            // jika sudah maka update stok
                            $gudangLumbung->stok = $gudangLumbung->stok + $request->jumlah[$key];
                            // dd($pembelian);
                            $gudangLumbung->save();
                        } else {
                            // jika belum maka create data baru
                            $gudang = GudangLumbung::create([
                                'nama_tanaman_id' => $data,
                                'kondisi_id' => $request->kondisi_id[$key],
                                'stok' => $request->jumlah[$key],
                                'keterangan_id' => '1',
                            ]);
                            $gudang->save();
                        }
                    }
                }
                DB::table('order_produk')->delete();
            } catch (\Throwable $th) {
                dd($th);
                DB::rollback();
                return back()->withInput()->withToastError('Something went wrong');
            }
        });

        return redirect(route('admin.pembelian.pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    public function detail(DetailPembelianProdukDataTable $dataTable, $id)
    {
        $pembelian = Pembelian::where('id',$id)->get();
        $data = DetailPembelianProduk::where('pembelian_id', $id)->get();
        return $dataTable->render('pages.admin.pembelian.show', [
            'id' => $id,
            'data' => $data,
            'pembelian' => $pembelian
        ]);
    }

    public function edit($id)
    {
        $data = Pembelian::findOrFail($id);
        $musim = PerkiraanPembelian::pluck('musim_panen', 'id');
        $tanaman = Tanaman::pluck('nama', 'id');
        $kondisi = KondisiHasilPanen::pluck('nama', 'id');
        $satuan = Satuan::pluck('satuan', 'id');
        $petani = DataPetani::pluck('nama', 'id');
        // relasi modal (pop up tambah produk)
        $jenistanaman = JenisTanaman::pluck('nama', 'id');
        $musimtanam = Musim::pluck('nama', 'id');
        $pupuk = DataPupuk::pluck('nama', 'id');
        return view('pages.admin.pembelian.add-edit', [
            'data' => $data,
            'musim' => $musim,
            'tanaman' => $tanaman,
            'kondisi' => $kondisi,
            'satuan' => $satuan,
            'petani' => $petani,
            'jenistanaman' => $jenistanaman,
            'musimtanam' => $musimtanam,
            'pupuk' => $pupuk
        ]);
    }

    public function update(PembelianForm $request, $id)
    {
        try {
            $data = Pembelian::findOrFail($id);
            $data->update($request->all());
        } catch (\Throwable $th) {
            return back()->withInput()->withToastError('Something went wrong');
        }

        return redirect(route('admin.pembelian.pembelian.index'))->withToastSuccess('Data tersimpan');
    }

    public function destroy($id)
    {
        try {
            Pembelian::find($id)->delete();
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function hapus($id)
    {
        try {
            OrderProduk::find($id)->delete();
            return redirect((route('admin.pembelian.pembelian.create')));
        } catch (\Throwable $th) {
            return response(['error' => 'Something went wrong']);
        }
    }

    public function invoice($no_pembelian)
    {
        $pembelianProduk = Pembelian::where('no_pembelian', $no_pembelian)->get();
        $data = DetailPembelianProduk::where('pembelian_id', $no_pembelian)->get();
        // dd($data);
        $pdf = PDF::loadview('pages.admin.pembelian.invoice', [
            'data' => $data,
            'no_pembelian' => $no_pembelian,
            'pembelianProduk' => $pembelianProduk
        ]);
        return $pdf->download('invoice-pembelian-produk.pdf');
        // return view('pages.admin.pembelian.invoice', [
        //     'data' => $data,
        //     'no_pembelian' => $no_pembelian,
        //     'pembelianProduk' => $pembelianProduk
        // ]);
    }

    public function laporanproduk(LaporanPembelianProdukDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.laporan-pembelian.index');

        // return view('pages.admin.laporan-pembelian.index');
    }
}
