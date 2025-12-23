<?php

namespace App\Http\Controllers;

use App\Services\FootballApiService;

class GameController extends Controller
{
    private FootballApiService $api;

    private int $teamId = 131;
    private int $leagueId = 71;
    private int $season = 2022;

    public function __construct(FootballApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        $games = $this->api->request('/fixtures', [
            'team'   => $this->teamId,
            'league' => $this->leagueId,
            'season' => $this->season
        ], 120);

        return view('games.index', compact('games'));
    }

    public function show(int $fixtureId)
{
    $response = $this->api->request('/fixtures', [
        'id' => $fixtureId
    ], 120);
    
 
    // O service já retorna o array correto
    $fixture = $response[0] ?? null;

    abort_if(!$fixture, 404);

    return view('games.show', compact('fixture'));
}

}
