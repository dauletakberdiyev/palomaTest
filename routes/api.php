<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('category')->name('category-')->group(function () {
    Route::get('', [CategoryController::class, 'index'])->name('index');
    Route::get('{category}', [CategoryController::class, 'show'])->whereNumber('category')->name('show');
});

Route::prefix('place')->name('place-')->group(function () {
    Route::get('', [PlaceController::class, 'index'])->name('index');
});

Route::prefix('order')->name('order-')->group(function () {
    Route::get('', [OrderController::class, 'index'])->name('index');
    Route::get('{order}', [OrderController::class, 'show'])->whereNumber('order')->name('show');
});


