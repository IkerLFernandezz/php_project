<?php

namespace App\Http\Controllers\Concerns;

use App\Services\Api\ApiException;

trait HandlesApiResources
{
    /**
     * Load an API index call, flashing a user-facing error if it fails.
     * Returns [] on failure — pair with the flashed error so the view can render gracefully.
     *
     * $label: human-friendly plural noun in Spanish, e.g. "cursos", "estudiantes".
     */
    protected function safeIndex($apiResource, string $label): array
    {
        try {
            return $apiResource->index();
        } catch (ApiException $e) {
            session()->flash('error', "No se pudieron cargar los {$label}: {$e->getMessage()}");
            return [];
        }
    }

    /**
     * Fetch an index from an API and filter client-side by a nested relation id.
     * E.g. filterByRelation($studentApi, 'course', $courseId, 'estudiantes')
     * keeps only students whose ['course']['id'] === $courseId.
     */
    protected function filterByRelation($apiResource, string $relationKey, string $id, string $label): array
    {
        try {
            $all = $apiResource->index();
        } catch (ApiException $e) {
            session()->flash('error', "No se pudieron cargar los {$label}: {$e->getMessage()}");
            return [];
        }

        return array_values(array_filter(
            $all,
            fn($item) => ($item[$relationKey]['id'] ?? null) === $id
        ));
    }
}