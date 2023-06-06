<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    //catalogo de peliculas
    Route::get('/catalog', [CatalogController::class, 'getIndex'])->name('catalog.index');

    //agregar peliculas
    Route::get('/catalog/create', [CatalogController::class, 'getCreate'])->name('catalog.getCreate');
    Route::post('/catalog/create', [CatalogController::class, 'postCreate'])->name('catalog.create');

    //mostrar pelicula
    Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow'])->where('id', '[0-9]+')->name('catalog.show');

    //eliminar pelicula
    Route::delete('/catalog/delete/{id}', [CatalogController::class, 'deleteMovie'])->name('catalog.delete');

    //editar película
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit'])->name('catalog.getEdit');
    Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit'])->name('catalog.edit');

    //alquilar película
    Route::put('/catalog/rent/{id}', [CatalogController::class, 'putRent'])->name('catalog.rent');

    //devoler pelicula
    Route::put('/catalog/return/{id}', [CatalogController::class, 'putReturn'])->name('catalog.return');
});

Route::get('/', [HomeController::class, 'getHome'])->name('home');

require __DIR__.'/auth.php';
