<?php
declare(strict_types=1);

namespace App\Domain\Department\Columns;

final class DepartmentName
{
    private string $name;

    public function __function(string $name)
    {
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}