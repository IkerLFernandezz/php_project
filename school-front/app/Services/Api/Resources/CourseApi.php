<?php

namespace App\Services\Api\Resources;

use App\Services\Api\SchoolApiClient;

class CourseApi
{
    public function __construct(private SchoolApiClient $client) {}

    public function index(): array
    {
        return $this->client->get('/api/courses');
    }

    public function show(string $id): array
    {
        return $this->client->get("/api/courses/{$id}");
    }

    public function create(array $data): array
    {
        return $this->client->post('/api/courses', $data);
    }

    public function update(string $id, array $data): array
    {
        return $this->client->put("/api/courses/{$id}", $data);
    }

    public function destroy(string $id): array
    {
        return $this->client->delete("/api/courses/{$id}");
    }
}