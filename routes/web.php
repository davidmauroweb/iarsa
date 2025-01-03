<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,Controller,EquiposController,ObrasController,ItemsController,PdiarioController};

Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'cnt'], function () {
//USUARIOS
Route::get('/lsusers', [App\Http\Controllers\lsusers::class, 'lista'])->name('lsus');
Route::post('/nus', [App\Http\Controllers\Auth\RegisterController::class, 'nuevo'])->name('nus');
Route::delete('/du/{u}', [App\Http\Controllers\lsusers::class, 'invertir'])->name('dus');
Route::put('/du/{u}', [App\Http\Controllers\Auth\RegisterController::class, 'mus'])->name('mus');
//COMITENTES
Route::get('/comitentes', [App\Http\Controllers\ComitentesController::class, 'index'])->name('lscomitentes');
Route::post('/ncom', [App\Http\Controllers\ComitentesController::class, 'nuevo'])->name('ncom');
Route::post('/ecom', [App\Http\Controllers\ComitentesController::class, 'edit'])->name('ecom');
});

//EQUIPAMIENTO
Route::group(['middleware' => 'mnt'], function () {
Route::get('/equipos', [EquiposController::class, 'index'])->name('lsequipos');
Route::post('/nequipos', [EquiposController::class, 'nuevo'])->name('nequipos');
Route::post('/eequipos', [EquiposController::class, 'edit'])->name('eequipos');
Route::post('/lspdmnt', [PdiarioController::class, 'showmnt'])->name('lspdmnt');
});

// middleware Jefe de Obra incluye Oficina Central
Route::group(['middleware' => 'obr'], function () {
//OBRAS
Route::get('/obras', [ObrasController::class, 'index'])->name('lsobras');
Route::post('/nobras', [ObrasController::class, 'nuevo'])->name('nobras');
Route::post('/eobras', [ObrasController::class, 'edit'])->name('eobras');
//ITEMS
Route::get('/items/{obra}', [ItemsController::class, 'index'])->name('lsitems');
Route::post('/nitems', [ItemsController::class, 'nuevo'])->name('nitems');
Route::post('/eitems', [ItemsController::class, 'edit'])->name('eitems');
});

Route::group(['middleware' => 'opr'], function () {
    Route::get('/homeopr', [PdiarioController::class, 'index'])->name('homeopr');
    Route::post('/fpdiario', [PdiarioController::class, 'show'])->name('fpdiario');
    Route::post('/npdiario', [PdiarioController::class, 'nuevo'])->name('npdiario');
    });