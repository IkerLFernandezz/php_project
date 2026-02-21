<?php
declare(strict_types=1);

namespace App\Domain\Course\Columns;

final class CourseName
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