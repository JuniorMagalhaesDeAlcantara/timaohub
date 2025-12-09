<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Http;

Route::get('/teams', function () {
    $response = Http::withHeaders([
        'x-apisports-key' => env('API_FOOTBALL_KEY'),
    ])->get('https://v3.football.api-sports.io/teams', [
        'league' => 71,   // Série A
        'season' => 2023, // temporada disponível
    ]);

    $teams = collect($response->json()['response'])->filter(function ($t) {
        return !empty($t['team']['logo']);
    });

    return view('teams', compact('teams'));
});



Route::get('/', [HomeController::class, 'index']);
Route::get('/jogos', [GameController::class, 'index'])->name('games.index');
