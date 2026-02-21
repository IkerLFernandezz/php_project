<?php
declare(strict_types=1);

namespace App\Domain\Student\Columns;

final class StudentName
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}