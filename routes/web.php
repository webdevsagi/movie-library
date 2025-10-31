<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;

Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/movie/{movie}', [CatalogController::class, 'show'])->name('catalog.show');



Route::resource('movies', MovieController::class);

Route::get('movies/import/search', [MovieController::class, 'importSearch'])->name('movies.import.search');
Route::post('movies/import/find', [MovieController::class, 'importFind'])->name('movies.import.find');
Route::post('movies/import/store', [MovieController::class, 'importStore'])->name('movies.import.store');
