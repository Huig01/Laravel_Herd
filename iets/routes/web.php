<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products', [ProductsController::class, 'index']) -> name('products.index');
Route::middleware('auth')->group(function () {
Route::get('/products/create', [ProductsController::class, 'create']) -> name('products.create');
Route::put('/products/{id}', [ProductsController::class, 'store']) -> name('products.store');
Route::get('/products/{products}/edit', [ProductsController::class, 'edit']) -> name('products.edit');
Route::delete('/products/{products}/destroy', [ProductsController::class, 'destroy']) -> name('products.destroy');
});

require __DIR__.'/auth.php';
