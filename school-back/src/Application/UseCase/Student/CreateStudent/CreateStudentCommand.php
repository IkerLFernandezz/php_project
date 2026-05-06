<?php
declare(strict_types=1);

namespace App\Application\UseCase\Student\CreateStudent;

final class CreateStudentCommand
{
    public function __construct(
        public string $name,
        public string $surname,
        public string $dni,
        public string $mail,
        public string $courseId
    ) {
    }
}