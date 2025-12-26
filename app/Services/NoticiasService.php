<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NoticiasService
{
    private string $baseUrl = 'https://gnews.io/api/v4/search';

    public function getNoticiasCorinthians(int $limit = 6)
    {
        return Cache::remember(
            "noticias_corinthians_{$limit}",
            now()->addMinutes(30),
            function () use ($limit) {

                $response = Http::get($this->baseUrl, [
                    'q'       => 'Corinthians',
                    'lang'    => 'pt',
                    'country' => 'br',
                    'max'     => $limit,
                    'apikey'  => config('services.gnews.key'),
                ]);

                if ($response->failed()) {
                    return collect();
                }

                return collect($response->json('articles'))
                    ->map(fn ($article) => $this->mapArticle($article));
            }
        );
    }

    public function findBySlug(string $slug)
    {
        // precisa buscar um pouco mais para garantir achar o slug
        return $this->getNoticiasCorinthians(12)
            ->firstWhere('slug', $slug);
    }

    private function mapArticle(array $article): array
    {
        return [
            'title'       => $article['title'],
            'description' => $article['description'] ?? '',
            'content'     => Str::limit($article['content'] ?? '', 300),
            'excerpt'     => Str::limit($article['description'] ?? '', 140),
            'image'       => $article['image'] ?? null,
            'url'         => $article['url'],
            'publishedAt' => $article['publishedAt'] ?? now(),
            'source'      => [
                'name' => $article['source']['name'] ?? 'Fonte externa',
            ],
            'slug'        => Str::slug($article['title']),
        ];
    }
}
