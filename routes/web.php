<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('products', [AdminProductController::class, 'index'])->name('products.index');
    Route::post('products/{product}/approve', [AdminProductController::class, 'approve'])->name('products.approve');
    Route::post('products/{product}/reject', [AdminProductController::class, 'reject'])->name('products.reject');
});
