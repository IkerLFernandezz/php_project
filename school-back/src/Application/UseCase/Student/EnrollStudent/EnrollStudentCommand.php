<?php
declare(strict_types=1);

namespace App\Application\UseCase\Student\EnrollStudent;

final class EnrollStudentCommand
{
    public function __construct(
        public string $studentId,
        public string $courseId
    ) {
    }
}