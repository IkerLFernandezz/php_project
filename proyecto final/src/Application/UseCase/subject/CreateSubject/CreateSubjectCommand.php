<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\CreateSubject;

final class CreateSubjectCommand
{
    public function __construct(
        public readonly string $name,
        public readonly string $courseId,
        public readonly string $teacherId
    ) {}
}