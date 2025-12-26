<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\NoticiasController;

// Home agora vem da GNews
Route::get('/', [NoticiasController::class, 'index']);


/*
|--------------------------------------------------------------------------
| TIMES - API FOOTBALL
|--------------------------------------------------------------------------
*/

// Lista geral de times da Série A
Route::get('/teams', function () {
    $response = Http::withHeaders([
        'x-apisports-key' => env('API_FOOTBALL_KEY'),
    ])->get('https://v3.football.api-sports.io/teams', [
        'league' => 71,   // Série A
        'season' => 2023,
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
        'id' => 131
    ]);

    $team = $response->json()['response'][0]['team'] ?? null;

    if (!$team) {
        abort(404, 'Corinthians não encontrado na API.');
    }

    return view('corinthians', ['team' => $team]);
});


/*
|--------------------------------------------------------------------------
| HOME - AGORA É NOTÍCIAS
|--------------------------------------------------------------------------
*/

// Home agora vem da GNews

Route::get('/noticia/{hash}', [NoticiasController::class, 'show'])
    ->name('noticias.show');


/*
|--------------------------------------------------------------------------
| ESTATÍSTICAS (HOME ANTIGA)
|--------------------------------------------------------------------------
*/

Route::get('/estatisticas', [HomeController::class, 'index'])
    ->name('estatisticas.index');


/*
|--------------------------------------------------------------------------
| JOGOS
|--------------------------------------------------------------------------
*/

Route::get('/jogos', [GameController::class, 'index'])
    ->name('games.index');

Route::get('/jogos/{fixtureId}', [GameController::class, 'show'])
    ->name('games.show');
