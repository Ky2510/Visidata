<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('me', [AuthController::class, 'me']);

    // Item
    Route::prefix('barang')->controller(ItemController::class)->group(function () {
        Route::get('/', 'index')->name('item.index');
        Route::post('/store', 'store')->name('item.store');
    });
    

    // Transaction
    Route::prefix('transaksi')->controller(TransactionController::class)->group(function () {
        Route::get('/', 'index')->name('transaction.index');
        Route::post('/store', 'store')->name('transaction.store');
    });
});
