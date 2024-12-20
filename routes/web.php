<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,Controller,EquiposController,ObrasController};

Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//USUARIOS
Route::get('/lsusers', [App\Http\Controllers\lsusers::class, 'lista'])->name('lsus');
Route::post('/nus', [App\Http\Controllers\Auth\RegisterController::class, 'nuevo'])->name('nus');
Route::delete('/du/{u}', [App\Http\Controllers\lsusers::class, 'invertir'])->name('dus');
Route::put('/du/{u}', [App\Http\Controllers\Auth\RegisterController::class, 'mus'])->name('mus');
//COMITENTES
Route::get('/comitentes', [App\Http\Controllers\ComitentesController::class, 'index'])->name('lscomitentes');
Route::post('/ncom', [App\Http\Controllers\ComitentesController::class, 'nuevo'])->name('ncom');
Route::post('/ecom', [App\Http\Controllers\ComitentesController::class, 'edit'])->name('ecom');
//EQUIPAMIENTO
Route::get('/equipos', [EquiposController::class, 'index'])->name('lsequipos');
Route::post('/nequipos', [EquiposController::class, 'nuevo'])->name('nequipos');
Route::post('/eequipos', [EquiposController::class, 'edit'])->name('eequipos');
//OBRAS
Route::get('/obras', [ObrasController::class, 'index'])->name('lsobras');
Route::post('/nobras', [ObrasController::class, 'nuevo'])->name('nobras');
Route::post('/eobras', [ObrasController::class, 'edit'])->name('eobras');