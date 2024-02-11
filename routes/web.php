<?php

use App\Http\Controllers\ProdukController;
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

Route::get('/', [ProfileController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tambah_produk', [ProdukController::class, 'index'])->name('tambah_produk');
    Route::get('/edit_produk/{id}', [ProdukController::class, 'edit'])->name('edit_produk');
    Route::delete('/delete_produk/{id}', [ProdukController::class, 'delete'])->name('delete_produk');
});

require __DIR__ . '/auth.php';
