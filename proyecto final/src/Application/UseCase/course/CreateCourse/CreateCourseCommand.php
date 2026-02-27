<?php
declare(strict_types=1);

namespace App\Application\UseCase\Course\CreateCourse;

final class CreateCourseCommand
{
    public function __construct(
        public readonly string $name,
        public readonly string $schedule
    ) {}
}