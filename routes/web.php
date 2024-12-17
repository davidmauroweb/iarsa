<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,Controller};

Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//USUARIOS
Route::get('/lsusers', [App\Http\Controllers\lsusers::class, 'lista'])->name('lsus');
Route::post('/nus', [App\Http\Controllers\Auth\RegisterController::class, 'nuevo'])->name('nus');
Route::delete('/du/{u}', [App\Http\Controllers\Auth\RegisterController::class, 'del'])->name('dus');
Route::put('/du/{u}', [App\Http\Controllers\Auth\RegisterController::class, 'mus'])->name('mus');
//COMITENTES
Route::get('/comitentes', [App\Http\Controllers\ComitentesController::class, 'index'])->name('lscomitentes');
Route::post('/ncom', [App\Http\Controllers\ComitentesController::class, 'nuevo'])->name('ncom');
Route::post('/ecom', [App\Http\Controllers\ComitentesController::class, 'edit'])->name('ecom');