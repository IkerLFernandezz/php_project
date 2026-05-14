<?php

namespace App\Services\Api;

use Exception;

class ApiException extends Exception
{
    public function __construct(
        string $message,
        public readonly int $statusCode = 0,
        public readonly array $payload = []
    ) {
        parent::__construct($message, $statusCode);
    }

    public static function fromResponse(int $statusCode, array $payload): self
    {
        $error = $payload['error'] ?? "API request failed with status {$statusCode}";
        $detail = $payload['message'] ?? null;
        $message = $detail ? "{$error}: {$detail}" : $error;
        return new self($message, $statusCode, $payload);
    }
}