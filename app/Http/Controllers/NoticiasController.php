<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class NoticiasController extends Controller
{
    public function index()
    {
        $response = Http::get('https://gnews.io/api/v4/search', [
            'q'       => 'Corinthians',
            'lang'    => 'pt',
            'country' => 'br',
            'max'     => 9,
            'apikey'  => env('GNEWS_API_KEY'),
        ]);

        $noticias = $response->json()['articles'] ?? [];

        return view('noticias.index', [
            'title'    => 'Notícias do Corinthians',
            'noticias' => $noticias,
        ]);
    }
}
