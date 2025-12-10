<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $apiKey = env('API_FOOTBALL_KEY');
        $teamId = 131; // Corinthians
        $league = 71;  // Brasileirão Série A
        $season = 2023; // API tem dados de 2023

        // INFORMAÇÕES DO TIME
        $teamResponse = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get("https://v3.football.api-sports.io/teams", [
            'id' => $teamId
        ])->json();

        $team = $teamResponse['response'][0]['team'] ?? null;
        $venue = $teamResponse['response'][0]['venue'] ?? null;

        // ESTATÍSTICAS DA TEMPORADA
        $statsResponse = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get("https://v3.football.api-sports.io/teams/statistics", [
            'team' => $teamId,
            'league' => $league,
            'season' => $season
        ])->json();

        $stats = $statsResponse['response'] ?? [];

        // ELENCO E ARTILHEIROS
        $playersResponse = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get("https://v3.football.api-sports.io/players", [
            'team' => $teamId,
            'season' => $season
        ])->json();

        $players = $playersResponse['response'] ?? [];

        // ARTILHEIROS DO CORINTHIANS (igual versão anterior)
        $scorers = collect($players)
            ->map(function ($p) {
                return [
                    'player' => $p['player'],
                    'goals' => $p['statistics'][0]['goals']['total'] ?? 0,
                    'assists' => $p['statistics'][0]['goals']['assists'] ?? 0,
                    'games' => $p['statistics'][0]['games']['appearences'] ?? 0
                ];
            })
            ->filter(fn($p) => $p['goals'] > 0)
            ->sortByDesc('goals')
            ->take(5)
            ->toArray();

        // ÚLTIMOS 5 JOGOS
        $fixturesResponse = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get("https://v3.football.api-sports.io/fixtures", [
            'team' => $teamId,
            'league' => $league,
            'season' => $season,
            'last' => 5
        ])->json();

        $lastGames = $fixturesResponse['response'] ?? [];

        // PRÓXIMO JOGO
        $nextGameResponse = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get("https://v3.football.api-sports.io/fixtures", [
            'team' => $teamId,
            'league' => $league,
            'season' => $season,
            'next' => 1
        ])->json();

        $nextGame = $nextGameResponse['response'][0] ?? null;

        // FORMA (sequência de resultados)
        $form = $stats['form'] ?? '';
        $formArray = array_slice(str_split($form), -5); // Últimos 5 resultados

        return view('home', compact(
            'team',
            'venue',
            'stats',
            'scorers',
            'lastGames',
            'nextGame',
            'formArray'
        ));
    }
}