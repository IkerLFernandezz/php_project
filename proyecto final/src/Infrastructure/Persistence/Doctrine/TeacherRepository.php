<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Teacher\Teacher;

interface TeacherRepository
{
    public function save(Teacher $teacher): void;

    public function findById(string $id): ?Teacher;

    public function findAll(): array;

    public function remove(Teacher $teacher): void;
}