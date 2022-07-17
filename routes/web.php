<?php

use App\Http\Controllers\BerandaController;
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

// Route::get('/', function () {
//     return redirect(route('beranda.index'));
// });

// Route::get('admin', function () {
//     return redirect(route('admin.dashboard'));
// });

Route::get('/token', function () {
    return csrf_token();
});

// Route::resource('beranda', 'BerandaController');
Route::view('/', 'pages.user.landingpage')->name('landingpage');
Route::resource('/dashboard', 'BerandaController');
// Route::group(['middleware' => 'auth:web', 'as' => 'user.'], function () {
//     Route::view('/', 'home')->name('home');

//     Route::group(['namespace' => 'User'], function () {
//         Route::resource('ketersediaan-produk', 'KetersediaanProdukController');
//         Route::resource('riwayat-penjualan', 'RiwayatPenjualanController');
//         Route::resource('menampilkandatapetani', 'MenampilkanDataPetaniController');
//     });
// });

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    require base_path('vendor/laravel/fortify/routes/routes.php');

    Route::group(['namespace' => 'User', 'middleware' => 'role:user_petani'], function () {
        // Route::view('/', 'home')->name('home');
        // Route::view('/user', 'pages.user.landingpage')->name('landingpage');
        Route::resource('ketersediaan-produk', 'KetersediaanProdukController');
        Route::resource('ketersediaan-pupuk', 'KetersediaanPupukController');
        Route::resource('riwayat-penjualan', 'RiwayatPenjualanController');
        // Route::resource('menampilkandatapetani', 'MenampilkanDataPetaniController');
    });
});
require __DIR__ . '/demo.php';
