<?php
declare(strict_types=1);

namespace App\Application\UseCase\Course\UpdateCourse;

final class UpdateCourseCommand
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $schedule
    ) {}
}