<?php
declare(strict_types=1);

namespace App\Domain\Course;

use App\Domain\Course\Course;

interface CourseRepositoryInterface
{
    public function save(Course $course): void;

    public function findById(string $id): ?Course;

    public function findAll(): array;

    public function remove(Course $course): void;
}