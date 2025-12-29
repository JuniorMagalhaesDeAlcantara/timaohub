<?php

namespace App\Http\Controllers;

use App\Services\NoticiasService;
use Illuminate\Support\Collection;

class NoticiasController extends Controller
{
    private NoticiasService $service;

    public function __construct(NoticiasService $service)
    {
        $this->service = $service;
    }

    /**
     * Exibe a lista de notícias do Corinthians
     */
    public function index()
    {
        // Busca mais notícias para permitir filtragem
        $noticias = collect(
            $this->service->getNoticiasCorinthians(12)
        );

        // Filtro de relevância (anti-CPTM 😅)
        $noticiasFiltradas = $noticias->filter(function ($noticia) {
            $texto = strtolower(
                ($noticia['title'] ?? '') . ' ' .
                ($noticia['excerpt'] ?? '')
            );

            return str_contains($texto, 'corinthians')
                && !str_contains($texto, 'cptm')
                && !str_contains($texto, 'metrô')
                && !str_contains($texto, 'estação');
        })->values();

        return view('noticias.index', [
            'destaque' => $noticiasFiltradas->first(),
            'noticias' => $noticiasFiltradas->skip(1),
        ]);
    }

    /**
     * Exibe a página de leitura da notícia
     */
    public function show(string $slug)
    {
        $noticia = $this->service->findBySlug($slug);

        if (empty($noticia)) {
            abort(404, 'Notícia não encontrada');
        }

        return view('noticias.show', [
            'noticia' => $noticia
        ]);
    }
}
