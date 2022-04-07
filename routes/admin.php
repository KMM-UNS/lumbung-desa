<?php

use Illuminate\Support\Facades\Route;

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

        Route::group(['prefix' => '/data-petani', 'as' => 'data-petani.', 'namespace' => 'DataPetani'], function () {
            Route::resource('petani', 'DataPetaniController');
           // Route::get('/image', 'DataPetaniController@index');
           // Route::post('/images','DataPetaniController@upload');
             Route::resource('tanaman', 'TanamanController');
             Route::resource('datalahan', 'DataLahanController');
        });

        Route::group(['prefix' => '/pembelian', 'as' => 'pembelian.', 'namespace' => 'Pembelian'], function () {
            Route::resource('pembelian', 'PembelianController');
        });

        Route::resource('datapetani', 'DataPetaniController');
        Route::resource('datapetani', 'DataPetaniController');
        Route::resource('penjualan', 'PenjualanController');

        Route::group(['prefix' => '/master-data', 'as' => 'master-data.', 'namespace' => 'Master'], function () {
            Route::resource('agama', 'AgamaController');
            // Route::get('file-upload', [ SliderController::class, 'Slider' ])->name('file.upload');
            // Route::post('file-upload', [ SliderController::class, 'Slider' ])->name('file.upload.post');
            Route::resource('pekerjaan', 'PekerjaanController');
            Route::resource('status-kawin', 'StatusKawinController');
            Route::resource('pendidikan', 'PendidikanController');
            Route::resource('datapupuk', 'DataPupukController');

            Route::resource('datajenislahan', 'DataJenisLahanController');
            Route::resource('jenistanaman', 'JenisTanamanController');
            // Route::resource('tanaman', 'TanamanController');
            Route::resource('musim', 'MusimController');
            Route::resource('kondisi-hasil-panen', 'KondisiHasilPanenController');

        });
    });
});
