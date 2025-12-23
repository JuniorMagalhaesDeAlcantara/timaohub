<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FootballApiService
{
    private string $apiKey;
    private string $baseUrl = 'https://v3.football.api-sports.io';

    public function __construct()
    {
        $this->apiKey = config('services.api_football.key');
    }

    public function request(string $endpoint, array $params = [], int $cacheMinutes = 60): array
    {
        $cacheKey = 'football_' . md5($endpoint . json_encode($params));

        return Cache::remember($cacheKey, now()->addMinutes($cacheMinutes), function () use ($endpoint, $params) {
            try {
                $response = Http::withHeaders([
                    'x-apisports-key' => $this->apiKey
                ])->get($this->baseUrl . $endpoint, $params);

                if ($response->successful()) {
                    return $response->json('response') ?? [];
                }

                Log::error('API Football error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [];
            } catch (\Throwable $e) {
                Log::error('API Football exception', [
                    'message' => $e->getMessage()
                ]);

                return [];
            }
        });
    }
}
