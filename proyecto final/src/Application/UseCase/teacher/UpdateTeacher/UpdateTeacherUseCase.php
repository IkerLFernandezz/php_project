<?php
declare(strict_types=1);

namespace App\Application\UseCase\Teacher\UpdateTeacher;

use App\Domain\Teacher\Columns\TeacherName;
use App\Domain\Teacher\Columns\TeacherSurname;
use App\Domain\Teacher\Columns\TeacherDni;
use App\Domain\Teacher\Columns\TeacherMail;
use App\Infrastructure\Persistence\Doctrine\DepartmentRepository;
use App\Infrastructure\Persistence\Doctrine\TeacherRepository;
use Exception;

final class UpdateTeacherUseCase
{
    public function __construct(
        private TeacherRepository $teacherRepository,
        private DepartmentRepository $departmentRepository
    ) {
    }

    public function execute(string $id, array $data): void
    {
        $teacher = $this->teacherRepository->findById($id);

        if (!$teacher) {
            throw new Exception("Teacher not found");
        }

        $department = $this->departmentRepository->findById($data['departmentId']);

        if (!$department) {
            throw new Exception("Department not found");
        }

        $teacher->setName(new TeacherName($data['name']));
        $teacher->setSurname(new TeacherSurname($data['surname']));
        $teacher->setDni(new TeacherDni($data['dni']));
        $teacher->setMail(new TeacherMail($data['mail']));
        $teacher->setDepartment($department);

        $this->teacherRepository->save($teacher);
    }
}