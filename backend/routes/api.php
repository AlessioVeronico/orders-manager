<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('product')->group(function () {
    Route::get('/list', [ProductController::class, 'list'])->name('product.list');
    Route::post('/save', [ProductController::class, 'save'])->name('product.save');
    Route::delete('/archive/{id}', [ProductController::class, 'archive'])->name('product.archive');
});

Route::prefix('order')->group(function () {
    Route::get('/list', [OrderController::class, 'list'])->name('order.list');
    Route::get('/filter', [OrderController::class, 'filter'])->name('order.filter');
    Route::post('/save', [OrderController::class, 'save'])->name('order.save');
    Route::delete('/archive/{id}', [OrderController::class, 'archive'])->name('order.archive');
});
