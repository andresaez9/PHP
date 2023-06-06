<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () { //para llevarnos a la ruta /home hemos entrado dentro de Controllers/AuthenticatedSession/RouteServiceProvider
    if(Auth::user()->type === 'admin') {
        return redirect(route('admin.index'));
    } else {
        return redirect(route('loan.index'));
    }
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () { //usuario normal
    Route::get('/loan', [LoanController::class, 'index'])->name('loan.index');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', [LoanController::class, 'showAll'])->name('admin.index');
    Route::get('/admin/show/{id_user}/{id_book}/{loan_date}', [LoanController::class, 'getShow'])->name('admin.show');
    Route::get('/admin/create', [LoanController::class, 'getCreate'])->name('admin.create');
    Route::get('/admin/edit/{id_user}/{id_book}/{loan_date}', [LoanController::class, 'getEdit'])->name('admin.getEdit');
    Route::get('/admin/delete/{id_user}/{id_book}/{loan_date}', [LoanController::class, 'getDelete'])->name('admin.getDelete');
    Route::post('/admin/create', [LoanController::class, 'postCreate'])->name('admin.postCreate');
    Route::put('/admin/edit/{id_user}/{id_book}/{loan_date}', [LoanController::class, 'putEdit'])->name('admin.putEdit');
    Route::delete('/admin/delete/{id_user}/{id_book}/{loan_date}', [LoanController::class, 'delete'])->name('admin.delete');
});

require __DIR__.'/auth.php';
