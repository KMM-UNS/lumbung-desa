<?php

use App\Models\PembelianModal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PenjualanController;
use App\Http\Controllers\Admin\DataPetani\TanamanController;
use App\Http\Controllers\Admin\Pembelian\PembelianController;
use App\Http\Controllers\admin\pembelian\PembelianModalController;
use App\Http\Controllers\Admin\Pembelian\PembelianPupukController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');
    Route::resource('/setting', 'SettingController');


    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard'));
        });

        Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');

        Route::resource('/admin', 'AdminController');
        Route::resource('/user', 'UserController');
        // Route::resource('datapetani', 'DataPetaniController');
        // Route::resource('penjualan', 'PenjualanController');

        Route::group(['prefix' => '/data-petani', 'as' => 'data-petani.', 'namespace' => 'DataPetani'], function () {
            Route::resource('petani', 'DataPetaniController');
            // Route::get('/storage', 'DataPetaniController@index');
            // Route::post('/images','DataPetaniController@upload');
            Route::post('tanaman/simpan', 'TanamanController@simpan')->name('tanaman.simpan');
            Route::resource('tanaman', 'TanamanController');
            // Route::post('tanaman', 'TanamanController@store')->name('tanaman.store');
            Route::resource('datalahan', 'DataLahanController');
        });

        Route::group(['prefix' => '/pembelian', 'as' => 'pembelian.', 'namespace' => 'Pembelian'], function () {
            Route::resource('pilih-pembelian', 'PilihPembelianController');
            // pembelian produk
            Route::resource('pembelian', 'PembelianController');
            Route::get('invoice/{id}', [PembelianController::class, 'invoice'])->name('invoice');
            Route::get('detail-invoice/{id}', [PembelianController::class, 'detail-invoice'])->name('detail-invoice');
            // pembelian pupuk
            Route::resource('pembelian-pupuk', 'PembelianPupukController');
            Route::get('invoice-pupuk/{id}', [PembelianPupukController::class, 'invoice'])->name('pembelian-pupuk.invoice');
            // perkiraan pembelian (modal)
            Route::resource('perkiraan-pembelian', 'PerkiraanPembelianController');
            Route::resource('pembelian-modal', 'PembelianModalController');
            Route::get('pembelian-modal/simpan/{id}', 'PembelianModalController@simpan')->name('pembelian-modal.simpan');
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
        });

        Route::group(['prefix' => '/riwayat', 'as' => 'riwayat.', 'namespace' => 'Riwayat'], function () {
            Route::resource('pembelian', 'RiwayatPembelianController');
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
