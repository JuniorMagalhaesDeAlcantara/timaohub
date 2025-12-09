<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('match_date', 'asc')->get()
            ->groupBy(function ($game) {
                return \Carbon\Carbon::parse($game->match_date)->translatedFormat('F Y');
            })
            ->map(function ($monthGroup) {
                return $monthGroup->groupBy('championship');
            });

        return view('games.index', compact('games'));
    }
}
