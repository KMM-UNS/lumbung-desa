<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PenjualanController;
use App\Http\Controllers\Admin\Pembelian\PembelianController;
use App\Http\Controllers\admin\pembelian\PembelianModalController;
use App\Http\Controllers\Admin\Pembelian\PembelianPupukController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');

    Route::group(['namespace' => 'Admin', 'middleware' => ['role:admin|admin_gudang']], function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard'));
        });

        Route::view('', 'pages.admin.dashboard')->name('dashboard');

        Route::resource('/admin', 'AdminController');
        Route::resource('/users', 'UserController');
        // Route::resource('datapetani', 'DataPetaniController');
        // Route::resource('penjualan', 'PenjualanController');

        Route::group(['prefix' => '/data-petani', 'as' => 'data-petani.', 'namespace' => 'DataPetani'], function () {
            Route::resource('petani', 'DataPetaniController');
            // Route::get('/storage', 'DataPetaniController@index');
            // Route::post('/images','DataPetaniController@upload');
            Route::post('tanaman/simpan', 'TanamanController@simpan')->name('tanaman.simpan');
            Route::resource('tanaman', 'TanamanController');
            Route::resource('datalahan', 'DataLahanController');
            Route::resource('datapenjual', 'DataPenjualController');
        });

        Route::group(['prefix' => '/pembelian', 'as' => 'pembelian.', 'namespace' => 'Pembelian'], function () {
            Route::resource('pilih-pembelian', 'PilihPembelianController');
            // pembelian produk
            Route::resource('pembelian', 'PembelianController');
            Route::post('pembelian-produk/cart', 'PembelianController@addToCart')->name('pembelian-produk.add');
            Route::get('pembelian-produk/hapus/{id}', 'PembelianController@hapus')->name('pembelian-produk.hapus');
            Route::get('pembelian-produk/detail/{id}', 'PembelianController@detail')->name('pembelian-produk.detail');
            Route::get('invoice/{id}','PembelianController@invoice')->name('invoice');
            // pembelian pupuk
            Route::resource('pembelian-pupuk', 'PembelianPupukController');
            Route::get('pembelian-pupuk/detail/{id}', 'PembelianPupukController@detail')->name('pembelian-pupuk.detail');
            Route::post('pembelian-pupuk/cart', 'PembelianPupukController@addToCart')->name('pembelian-pupuk.add');
            Route::get('pembelian-pupuk/hapus/{id}', 'PembelianPupukController@hapus')->name('pembelian-pupuk.hapus');
            Route::get('invoice-pupuk/{id}', 'PembelianPupukController@invoice')->name('pembelian-pupuk.invoice');
            // perkiraan pembelian (modal)
            Route::resource('perkiraan-pembelian', 'PerkiraanPembelianController');
            Route::resource('pembelian-modal', 'PembelianModalController');
            Route::get('pembelian-modal/simpan/{id}', 'PembelianModalController@simpan')->name('pembelian-modal.simpan');
            Route::get('cetak-perkiraan-pembelian', [PembelianModalController::class, 'cetak'])->name('pembelian-modal.cetak');
            // Route::resource('pembelian-modal/{id}', [PembelianModalController::class, 'create']);
            // Route::resource('perkiraan-pembelian/{id}', 'PembelianModalController');
            // Route::get('perkiraan-pembelian/update/{id}', [PembelianModalController::class, 'update']);
        });

        Route::resource('penjualan', 'PenjualanController');
        Route::get('invoice/{id}', [PenjualanController::class, 'invoice'])->name('invoice');

        Route::group(['prefix' => '/gudang-lumbung', 'as' => 'gudang-lumbung.', 'namespace' => 'GudangLumbung'], function() {
            Route::resource('pilih-gudang', 'PilihGudangController');
            Route::resource('gudang-produk', 'GudangLumbungController');
            Route::resource('gudang-pupuk', 'GudangPupukController');
            Route::resource('laporan', 'LaporanGudangController');
        });

        Route::group(['prefix' => '/riwayat', 'as' => 'riwayat.', 'namespace' => 'Riwayat'], function () {
            Route::resource('pembelian', 'RiwayatPembelianController');
        });

        Route::group(['prefix' => '/laporan-pembelian', 'as' => 'laporan-pembelian.', 'namespace' => 'Pembelian'], function () {
            Route::get('laporan-pembelian-produk', 'PembelianController@laporanproduk')->name('produk');
            Route::get('laporan-pembelian-pupuk', 'PembelianPupukController@laporanpupuk')->name('pupuk');
        });

        Route::resource('kas', 'KasController');

        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master'], function () {
            // Route::get('file-upload', [ SliderController::class, 'Slider' ])->name('file.upload');
            // Route::post('file-upload', [ SliderController::class, 'Slider' ])->name('file.upload.post');
            Route::resource('datapupuk', 'DataPupukController');
            Route::post('datapupuk/simpan', 'DataPupukController@simpan')->name('datapupuk.simpan');
            Route::resource('datajenislahan', 'DataJenisLahanController');
            Route::resource('jenistanaman', 'JenisTanamanController');
            Route::resource('musim', 'MusimController');
            Route::resource('kondisi-hasil-panen', 'KondisiHasilPanenController');
            Route::resource('keterangan-gudang', 'KeteranganGudangController');
            // Route::resource('satuan', 'SatuanController');
            Route::resource('kategori-kas', 'KategoriKasController');
            Route::resource('kategori-pembayaran', 'KategoriPembayaranController');
            Route::post('kategori-pembayaran/simpan', 'KategoriPembayaranController@simpan')->name('kategori-pembayaran.simpan');
        });
    });
});
