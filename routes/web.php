<?php

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index']);
        Route::get('data_produk_admin', [AdminController::class, 'data_produk_admin']);
        Route::get('input_data_product', [AdminController::class, 'input_data_product']);
        Route::post('store_data_product', [AdminController::class, 'store_data_product']);
        Route::get('edit_data_product_admin/{id}', [AdminController::class, 'edit_data_product_admin']);
        Route::put('update_data_product/{id}', [AdminController::class, 'update_data_product']);
        Route::get('hapus_data_product_admin/{id}', [AdminController::class, 'hapus_data_product_admin']);
        Route::get('report_penjualan', [AdminController::class, 'report_penjualan']);
    });

    Route::middleware(['pelanggan'])->group(function () {
        Route::get('pelanggan', [PelangganController::class, 'index']);
        Route::get('product_list', [PelangganController::class, 'product_list']);
        Route::get('detail_product/{id}', [PelangganController::class, 'detail_product']);
        Route::get('buy_product/{id}', [PelangganController::class, 'buy_product']);
        Route::get('checkout_page', [PelangganController::class, 'checkout_page']);
        Route::post('confirmasi_checkout', [PelangganController::class, 'confirmasi_checkout']);
    });
});
