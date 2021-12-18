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
	Route::get('/', Controllers\HomeController::class)->name('home');
	Route::get('/edit', [Controllers\HomeController::class, 'edit'])->name('home.edit');
	Route::get('/predictions/print', [Controllers\PredictionController::class, 'print'])->name('predictions.print');
	Route::get('/productions/print', [Controllers\ProductionController::class, 'print'])->name('productions.print');
	Route::put('/update', [Controllers\HomeController::class, 'update'])->name('home.update');

	// resources
	Route::resource('galleries', Controllers\GalleryController::class);
	Route::resource('predictions', Controllers\PredictionController::class)
		->parameters(['predictions' => 'production'])
		->except(['create', 'store']);
	Route::resource('productions', Controllers\ProductionController::class);
	Route::resource('templates', Controllers\TemplateController::class);
});
