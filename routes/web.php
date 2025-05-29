<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return view('dashboard');
});

Route::resource('unidades', UnitController::class);
Route::resource('usuarios', UserController::class);
Route::resource('blocos', BlockController::class);
