<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OctagonApi
{
    public function fighters(): array
    {
        return $this->remember('fighters', fn(): array => $this->get('fighters'), []);
    }

    public function fighter(string $id): ?array
    {
        return $this->remember("fighter.{$id}", fn(): array => $this->get("fighter/{$id}"));
    }

    public function rankings(): array
    {
        return $this->remember('rankings', fn(): array => $this->get('rankings'), []);
    }

    public function division(string $id): ?array
    {
        return $this->remember("division.{$id}", fn(): array => $this->get("division/{$id}"));
    }

    private function remember(string $key, callable $callback, mixed $fallback = null): mixed
    {
        try {
            return Cache::remember(
                "octagon-api.{$key}",
                config('services.octagon.cache_ttl'),
                $callback,
            );
        } catch (RequestException $exception) {
            Log::warning('Octagon API request failed.', [
                'key' => $key,
                'status' => $exception->response?->status(),
            ]);

            return $fallback;
        }
    }

    private function get(string $path): array
    {
        return Http::baseUrl(config('services.octagon.base_url'))
            ->acceptJson()
            ->timeout(config('services.octagon.timeout'))
            ->retry(2, 150)
            ->get($path)
            ->throw()
            ->json();
    }
}