<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/jogos', [GameController::class, 'index'])->name('games.index');

