<?php
declare(strict_types=1);

namespace App\Domain\Student;

use App\Domain\Student\Student;

interface StudentRepositoryInterface
{
    public function save(Student $student): void;

    public function findById(string $id): ?Student;

    public function findAll(): array;

    public function remove(Student $student): void;
}