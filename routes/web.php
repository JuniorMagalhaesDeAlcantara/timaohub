<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;

// Lista geral de times da Série A
Route::get('/teams', function () {
    $response = Http::withHeaders([
        'x-apisports-key' => env('API_FOOTBALL_KEY'),
    ])->get('https://v3.football.api-sports.io/teams', [
        'league' => 71,   // Série A
        'season' => 2023, // temporada
    ]);

    $teams = collect($response->json()['response'])->filter(function ($t) {
        return !empty($t['team']['logo']);
    });

    return view('teams', compact('teams'));
});

// Página exclusiva do Corinthians
Route::get('/corinthians', function () {
    $response = Http::withHeaders([
        'x-apisports-key' => env('API_FOOTBALL_KEY'),
    ])->get('https://v3.football.api-sports.io/teams', [
        'id' => 131   // ID do Corinthians
    ]);

    $team = $response->json()['response'][0]['team'] ?? null;

    if (!$team) {
        abort(404, 'Corinthians não encontrado na API.');
    }

    return view('corinthians', ['team' => $team]);
});

// Home com estatísticas
Route::get('/', [HomeController::class, 'index']);

// Jogos do Corinthians
Route::get('/jogos', [GameController::class, 'index'])->name('games.index');
