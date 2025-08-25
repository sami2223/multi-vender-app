<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductApprovalController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['web'])->group(function () {
    // Vendor product routes - assume auth is handled externally or via session
    Route::middleware('vendor')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Admin approval routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/products', [ProductApprovalController::class, 'index'])->name('admin.products.index');
        Route::post('/products/{product}/approve', [ProductApprovalController::class, 'approve'])->name('admin.products.approve');
        Route::post('/products/{product}/reject', [ProductApprovalController::class, 'reject'])->name('admin.products.reject');
    });
});
