<?php
declare(strict_types=1);

namespace App\Domain\Subject\Columns;

final class SubjectId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = trim($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}