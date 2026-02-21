<?php
declare(strict_types=1);

namespace App\Domain\Teacher\Columns;

final class TeacherName
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