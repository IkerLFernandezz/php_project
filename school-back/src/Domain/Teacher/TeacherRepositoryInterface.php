<?php
declare(strict_types=1);

namespace App\Domain\Teacher;

use App\Domain\Teacher\Teacher;

interface TeacherRepositoryInterface
{
    public function save(Teacher $teacher): void;

    public function findById(string $id): ?Teacher;

    public function findAll(): array;

    public function remove(Teacher $teacher): void;
}