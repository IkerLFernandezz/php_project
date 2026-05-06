<?php

namespace App\Services\Api\Resources;

use App\Services\Api\SchoolApiClient;

class SubjectApi
{
    public function __construct(private SchoolApiClient $client) {}

    public function index(): array
    {
        return $this->client->get('/api/subjects');
    }

    public function show(string $id): array
    {
        return $this->client->get("/api/subjects/{$id}");
    }

    public function create(array $data): array
    {
        return $this->client->post('/api/subjects', $data);
    }

    public function update(string $id, array $data): array
    {
        return $this->client->put("/api/subjects/{$id}", $data);
    }

    public function destroy(string $id): array
    {
        return $this->client->delete("/api/subjects/{$id}");
    }

    public function assignTeacher(string $subjectId, string $teacherId): array
    {
        return $this->client->post("/api/subjects/{$subjectId}/assign-teacher", [
            'teacherId' => $teacherId,
        ]);
    }
}