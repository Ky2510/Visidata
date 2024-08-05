<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'loginIndex'])->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'loginWeb'])->name('login.store')->middleware('guest');
Route::get('register', [AuthController::class, 'registerIndex'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'registerWeb'])->name('register.store')->middleware('guest');
Route::get('logout', [AuthController::class, 'logoutWeb'])->name('logout')->middleware('auth');


Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware('auth');
Route::get('/barang', [HomeController::class, 'item'])->name('item.index')->middleware('auth');
Route::post('/barang/store', [HomeController::class, 'itemStore'])->name('transaction.store')->middleware('auth');
