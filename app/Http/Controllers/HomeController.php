<?php

namespace App\Http\Controllers;

use App\Services\FootballApiService;

class HomeController extends Controller
{
    private FootballApiService $api;

    private int $teamId = 131;       // Corinthians
    private int $leagueId = 71;      // Brasileirão
    private int $currentSeason = 2022; // limite do plano free

    public function __construct(FootballApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        // 1. Time
        $teamData = $this->api->request('/teams', [
            'id' => $this->teamId
        ], 1440);

        $team  = $teamData[0]['team'] ?? [];
        $venue = $teamData[0]['venue'] ?? null;

        // 2. Estatísticas
        $stats = $this->api->request('/teams/statistics', [
            'team'   => $this->teamId,
            'league' => $this->leagueId,
            'season' => $this->currentSeason
        ], 360);

        if (empty($stats)) {
            $stats = $this->getDefaultStats();
        }

        // Forma (últimos resultados)
        $formArray = [];
        if (!empty($stats['form'])) {
            $formArray = array_slice(
                array_reverse(str_split($stats['form'])),
                0,
                5
            );
        }

        // 3. Próximo jogo
        $nextGames = $this->api->request('/fixtures', [
            'team'   => $this->teamId,
            'league' => $this->leagueId,
            'season' => $this->currentSeason,
            'next'   => 1
        ], 30);

        $nextGame = $nextGames[0] ?? null;

        // 4. Artilheiros (filtrado pelo Corinthians)
        $scorers = $this->api->request('/players/topscorers', [
            'league' => $this->leagueId,
            'season' => $this->currentSeason
        ], 720);

        $processedScorers = collect($scorers)
            ->filter(fn ($player) =>
                ($player['statistics'][0]['team']['id'] ?? null) === $this->teamId
            )
            ->map(fn ($player) => [
                'player'  => $player['player'],
                'goals'   => $player['statistics'][0]['goals']['total'] ?? 0,
                'assists' => $player['statistics'][0]['goals']['assists'] ?? 0,
                'games'   => $player['statistics'][0]['games']['appearences'] ?? 0,
                'rating'  => $player['statistics'][0]['games']['rating'] ?? null,
            ])
            ->sortByDesc('goals')
            ->take(10)
            ->values()
            ->toArray();

        // 5. Últimos jogos
        $lastGames = $this->api->request('/fixtures', [
            'team'   => $this->teamId,
            'league' => $this->leagueId,
            'season' => $this->currentSeason,
            'last'   => 5
        ], 60);

        // 6. Classificação
        $standings = $this->api->request('/standings', [
            'league' => $this->leagueId,
            'season' => $this->currentSeason
        ], 360);

        $standing = collect($standings[0]['league']['standings'][0] ?? [])
            ->first(fn ($team) => $team['team']['id'] === $this->teamId);

        return view('home', compact(
            'team',
            'venue',
            'stats',
            'formArray',
            'nextGame',
            'processedScorers',
            'lastGames',
            'standing'
        ));
    }

    private function getDefaultStats(): array
    {
        return [
            'league' => [
                'name' => 'Brasileirão Série A',
                'season' => $this->currentSeason
            ],
            'fixtures' => [
                'played' => ['total' => 0],
                'wins'   => ['total' => 0],
                'draws'  => ['total' => 0],
                'loses'  => ['total' => 0]
            ],
            'goals' => [
                'for' => [
                    'total'   => ['total' => 0],
                    'average' => ['total' => 0]
                ],
                'against' => [
                    'total'   => ['total' => 0],
                    'average' => ['total' => 0]
                ]
            ],
            'clean_sheet' => ['total' => 0],
            'form' => ''
        ];
    }
}
