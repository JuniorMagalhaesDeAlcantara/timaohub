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
     * Lista de notícias do Corinthians
     */
    public function index()
    {
        $noticias = collect(
            $this->service->getNoticiasCorinthians(15)
        );

        $palavrasBloqueadas = [
            'cptm',
            'metrô',
            'metro',
            'estação',
            'estacoes',
            'linha',
            'trem',
            'transporte'
        ];

        $noticiasFiltradas = $noticias->filter(function ($noticia) use ($palavrasBloqueadas) {

            $texto = strtolower(
                ($noticia['title'] ?? '') . ' ' .
                ($noticia['excerpt'] ?? '') . ' ' .
                ($noticia['slug'] ?? '')
            );

            $fonte = strtolower($noticia['source']['name'] ?? '');

            // Deve falar de Corinthians (clube)
            if (!str_contains($texto, 'corinthians')) {
                return false;
            }

            // Bloqueia transporte público em qualquer campo
            foreach ($palavrasBloqueadas as $bloqueada) {
                if (str_contains($texto, $bloqueada) || str_contains($fonte, $bloqueada)) {
                    return false;
                }
            }

            return true;
        })->values();

        return view('noticias.index', [
            'destaque' => $noticiasFiltradas->first(),
            'noticias' => $noticiasFiltradas->skip(1),
        ]);
    }

    /**
     * Página de leitura da notícia
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
