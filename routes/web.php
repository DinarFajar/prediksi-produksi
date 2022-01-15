<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
	// home
	Route::get('/', Controllers\HomeController::class)->name('home');
	Route::get('/edit', [Controllers\HomeController::class, 'edit'])->name('home.edit');
	Route::put('/update', [Controllers\HomeController::class, 'update'])->name('home.update');
	
	// galeri
	Route::get('/galeri/all', [Controllers\GalleryController::class, 'all'])->name('galeri.all');
	
	// prediksi
	Route::get('/prediksi/cetak', [Controllers\PrediksiController::class, 'print'])->name('prediksi.print');
	
	// produksi
	Route::get('/produksi/cetak', [Controllers\ProduksiController::class, 'print'])->name('produksi.print');
	Route::post('/produksi/{produksi}', [Controllers\ProduksiController::class, 'store'])->name('produksi.store');
	Route::post('/produksi/{produksi}/manual', [Controllers\ProduksiController::class, 'storeManually'])->name('produksi.storeManually');
	
	// others
	Route::match(['get', 'post'], '/fuzzy-mamdani', Controllers\FuzzyMamdaniController::class)->name('fuzzy-mamdani');

	// resources
	Route::resource('galeri', Controllers\GalleryController::class)->parameters(['galeri' => 'gallery'])->except(['show', 'edit', 'update']);
	Route::resource('permintaan', Controllers\PermintaanController::class)->except(['show']);
	Route::resource('prediksi', Controllers\PrediksiController::class)->only(['index']);
	Route::resource('produksi', Controllers\ProduksiController::class)->except(['create', 'store', 'show']);
});