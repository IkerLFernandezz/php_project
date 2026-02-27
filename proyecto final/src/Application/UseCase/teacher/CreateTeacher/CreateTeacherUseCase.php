<?php
declare(strict_types=1);

namespace App\Application\UseCase\Teacher\CreateTeacher;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\Columns\TeacherId;
use App\Domain\Teacher\Columns\TeacherName;
use App\Domain\Teacher\Columns\TeacherSurname;
use App\Domain\Teacher\Columns\TeacherDni;
use App\Domain\Teacher\Columns\TeacherMail;
use App\Infrastructure\Persistence\Doctrine\DepartmentRepository;
use App\Infrastructure\Persistence\Doctrine\TeacherRepository;
use Exception;

final class CreateTeacherUseCase
{
    public function __construct(
        private TeacherRepository $teacherRepository,
        private DepartmentRepository $departmentRepository
    ) {
    }

    public function execute(CreateTeacherCommand $command): void
    {
        $department = $this->departmentRepository->findById($command->departmentId);

        if (!$department) {
            throw new Exception("Department not found");
        }

        $id = bin2hex(random_bytes(16));

        $teacher = new Teacher(
            new TeacherId($id),
            new TeacherName($command->name),
            new TeacherSurname($command->surname),
            new TeacherDni($command->dni),
            new TeacherMail($command->mail)
        );

        $teacher->setDepartment($department);

        $this->teacherRepository->save($teacher);
    }
}