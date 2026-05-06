<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\UpdateSubject;

final class UpdateSubjectCommand
{
    public function __construct(
        public readonly string $subjectId,
        public readonly string $name,
        public readonly string $teacherId
    ) {}
}