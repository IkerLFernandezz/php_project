<?php
declare(strict_types=1);

namespace App\Domain\Teacher\Columns;

final class TeacherId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }
}