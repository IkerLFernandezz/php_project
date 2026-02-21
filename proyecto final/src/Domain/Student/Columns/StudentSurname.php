<?php
declare(strict_types=1);

namespace App\Domain\Student\Columns;

final class StudentSurname
{
    private string $surname;

    public function __construct(string $surname)
    {
        $this->surname = $surname;
    }

    public function value(): string
    {
        return $this->surname;
    }
}