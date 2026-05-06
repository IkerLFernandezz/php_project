<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\AssignTeacher;

final class AssignTeacherToSubjectCommand
{
    public function __construct(
        public string $subjectId,
        public string $teacherId
    ) {}
}