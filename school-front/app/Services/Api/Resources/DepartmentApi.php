<?php

namespace App\Services\Api\Resources;

use App\Services\Api\SchoolApiClient;

class DepartmentApi
{
    public function __construct(private SchoolApiClient $client) {}

    public function index(): array
    {
        return $this->client->get('/api/departments');
    }

    public function show(string $id): array
    {
        return $this->client->get("/api/departments/{$id}");
    }

    public function create(array $data): array
    {
        return $this->client->post('/api/departments', $data);
    }

    public function update(string $id, array $data): array
    {
        return $this->client->put("/api/departments/{$id}", $data);
    }

    public function destroy(string $id): array
    {
        return $this->client->delete("/api/departments/{$id}");
    }
}