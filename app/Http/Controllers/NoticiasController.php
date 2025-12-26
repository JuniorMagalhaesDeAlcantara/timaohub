<?php

namespace App\Http\Controllers;

use App\Services\NoticiasService;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    private NoticiasService $service;

    public function __construct(NoticiasService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista de notícias
     */
    public function index()
    {
        $noticias = $this->service->getNoticiasCorinthians(7);

        return view('noticias.index', [
            'destaque' => $noticias->first(),
            'noticias' => $noticias->skip(1),
        ]);
    }

    /**
     * Página de leitura da notícia
     */
    public function show(string $slug)
    {
        $noticia = $this->service->findBySlug($slug);

        if (!$noticia) {
            abort(404, 'Notícia não encontrada');
        }

        return view('noticias.show', [
            'noticia' => $noticia
        ]);
    }
}
