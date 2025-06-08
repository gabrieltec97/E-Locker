<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::resource('unidades', UnitController::class);
Route::resource('usuarios', UserController::class);
Route::resource('blocos', BlockController::class);
Route::resource('entregas', PacketController::class);

Route::get('/verificar-email', [UserController::class, 'checkEmail']);
