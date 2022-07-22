<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/token', function () {
    return csrf_token();
});

// Route::view('/', 'pages.user.landingpage')->name('landingpage');
Route::view('/', 'pages.user.landingpage')->name('landingpage');


Route::group(['middleware' => 'auth:web', 'as' => 'user.'], function () {
    Route::view('/', 'home')->name('home');

    Route::group(['namespace' => 'User'], function () {
        Route::resource('menampilkandatapetani', 'MenampilkanDataPetaniController');
        Route::resource('menampilkandatalahan', 'MenampilkanDataLahanController');
        Route::resource('ketersediaan-produk', 'KetersediaanProdukController');
        Route::resource('riwayat-penjualan', 'RiwayatPenjualanController');
        Route::resource('menampilkandatapetani', 'MenampilkanDataPetaniController');
    });
});

// Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
//     Route::group(['namespace' => 'User', 'middleware' => 'auth:web'], function () {
//         Route::view('/', 'home')->name('home');
//             Route::resource('ketersediaan-produk', 'KetersediaanProdukController');

//     });
// });
require __DIR__ . '/demo.php';
