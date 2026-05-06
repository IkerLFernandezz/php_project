<?php

namespace App\Services\Api\Resources;

use App\Services\Api\SchoolApiClient;

class TeacherApi
{
    public function __construct(private SchoolApiClient $client) {}

    public function index(): array
    {
        return $this->client->get('/api/teachers');
    }

    public function show(string $id): array
    {
        return $this->client->get("/api/teachers/{$id}");
    }

    public function create(array $data): array
    {
        return $this->client->post('/api/teachers', $data);
    }

    public function update(string $id, array $data): array
    {
        return $this->client->put("/api/teachers/{$id}", $data);
    }

    public function destroy(string $id): array
    {
        return $this->client->delete("/api/teachers/{$id}");
    }
}