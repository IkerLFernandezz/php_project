<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Course\Course;

interface CourseRepository
{
    public function save(Course $course): void;

    public function findById(string $id): ?Course;

    public function findAll(): array;

    public function remove(Course $course): void;
}