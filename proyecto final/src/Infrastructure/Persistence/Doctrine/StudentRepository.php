<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Student\Student;

interface StudentRepository
{
    public function save(Student $student): void;

    public function findById(string $id): ?Student;

    public function findAll(): array;

    public function remove(Student $student): void;
}