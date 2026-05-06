<?php

namespace App\Services\Api;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SchoolApiClient
{
    public function __construct(
        private string $baseUrl,
        private int $timeout = 10,
    ) {
    }

    public function get(string $path, array $query = []): array
    {
        return $this->handle($this->request()->get($path, $query));
    }

    public function post(string $path, array $body = []): array
    {
        return $this->handle($this->request()->post($path, $body));
    }

    public function put(string $path, array $body = []): array
    {
        return $this->handle($this->request()->put($path, $body));
    }

    public function delete(string $path): array
    {
        return $this->handle($this->request()->delete($path));
    }

    private function request(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->acceptJson()
            ->asJson();
    }

    private function handle(Response $response): array
    {
        $payload = $response->json() ?? [];

        if ($response->failed()) {
            throw ApiException::fromResponse($response->status(), is_array($payload) ? $payload : []);
        }

        return is_array($payload) ? $payload : [];
    }
}