<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/teste', function () {

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('unidades', UnitController::class);
Route::resource('usuarios', UserController::class);
Route::resource('blocos', BlockController::class);
