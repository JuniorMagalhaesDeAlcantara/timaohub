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
            'max'     => 10,
            'apikey'  => env('GNEWS_API_KEY'),
        ]);

        $articles = $response->json()['articles'] ?? [];

        $destaque = $articles[0] ?? null;
        $noticias = array_slice($articles, 1);

        return view('noticias.index', [
            'title'    => 'Notícias do Corinthians',
            'destaque' => $destaque,
            'noticias' => $noticias,
        ]);
    }

    // Página interna da notícia
    public function show($hash)
    {
        $response = Http::get('https://gnews.io/api/v4/search', [
            'q'       => 'Corinthians',
            'lang'    => 'pt',
            'country' => 'br',
            'max'     => 10,
            'apikey'  => env('GNEWS_API_KEY'),
        ]);

        $articles = $response->json()['articles'] ?? [];

        $noticia = collect($articles)->first(function ($item) use ($hash) {
            return md5($item['url']) === $hash;
        });

        if (!$noticia) {
            abort(404);
        }

        return view('noticias.show', [
            'title'   => $noticia['title'],
            'noticia' => $noticia,
        ]);
    }
}
