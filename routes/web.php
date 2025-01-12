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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/listAjax', [App\Http\Controllers\HomeController::class, 'listAjax'])->name('produk.listAjax');

Route::get('/Produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
Route::get('/Tambah_Produk', [App\Http\Controllers\ProdukController::class, 'create'])->name('produk.create');
Route::post('/Simpan_Produk', [App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');
Route::get('/Edit_Produk/{id}', [App\Http\Controllers\ProdukController::class, 'edit'])->name('produk.edit');
Route::post('/Update_Produk/{id}', [App\Http\Controllers\ProdukController::class, 'update'])->name('produk.update');
Route::get('/Delete_Produk/{id}', [App\Http\Controllers\ProdukController::class, 'delete'])->name('produk.delete');

Route::get('/Produk_Dijual', [App\Http\Controllers\ProdukController::class, 'produk_sell'])->name('produk.produk_sell');
