<?php

namespace App\Services\Api\Resources;

use App\Services\Api\SchoolApiClient;

class StudentApi
{
    public function __construct(private SchoolApiClient $client) {}

    public function index(): array
    {
        return $this->client->get('/api/students');
    }

    public function show(string $id): array
    {
        return $this->client->get("/api/students/{$id}");
    }

    public function create(array $data): array
    {
        return $this->client->post('/api/students', $data);
    }

    public function update(string $id, array $data): array
    {
        return $this->client->put("/api/students/{$id}", $data);
    }

    public function destroy(string $id): array
    {
        return $this->client->delete("/api/students/{$id}");
    }
}