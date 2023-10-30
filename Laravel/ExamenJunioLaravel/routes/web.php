<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/categories', [CategoryController::class, 'getCategories'])->name('category.index');
    Route::get('/articles/{id}', [ProductController::class, 'getProducts'])->name('product.index');
    Route::post('/order/{idProd}', [OrderController::class, 'processForm'])->name('order.process');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/viewDelete/{id}', [OrderController::class, 'getViewDelete'])->name('order.viewDelete');
    Route::delete('/order/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
    Route::get('/order/viewUpdate/{id}', [OrderController::class, 'getViewUpdate'])->name('order.viewUpdate');
    Route::put('/order/update/{id}/{quantity}', [OrderController::class, 'update'])->name('order.update');
    Route::get('/order/ready/{totalPrice}', [OrderController::class, 'orderReady'])->name('order.ready');
    Route::get('/order/finish/{price}', [OrderController::class, 'finishOrder'])->name('order.finish');
});

require __DIR__.'/auth.php';
