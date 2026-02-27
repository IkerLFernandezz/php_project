<?php
declare(strict_types=1);

namespace App\Application\UseCase\Teacher\CreateTeacher;

final class CreateTeacherCommand
{
    public function __construct(
        public readonly string $name,
        public readonly string $surname,
        public readonly string $dni,
        public readonly string $mail,
        public readonly string $departmentId
    ) {}
}