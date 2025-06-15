<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect(route('login'));
});

Route::middleware(['auth'])->group(function (){
    Route::middleware(['role:Administrador'])->group(function (){
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::resource('usuarios', UserController::class);
        Route::get('/verificar-email', [UserController::class, 'checkEmail']);
    });

    Route::middleware(['role:Administrador|Operador'])->group(function (){
        Route::resource('unidades', UnitController::class);
        Route::resource('blocos', BlockController::class);
        Route::resource('entregas', PacketController::class);
    });
});
