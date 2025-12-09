<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('match_date', 'desc')->get();

        return view('games.index', compact('games'));
    }
}

