<?php
declare(strict_types=1);

namespace App\Application\UseCase\Student\UpdateStudent;

use App\Domain\Course\CourseRepositoryInterface;
use App\Domain\Student\Columns\StudentDni;
use App\Domain\Student\Columns\StudentMail;
use App\Domain\Student\Columns\StudentName;
use App\Domain\Student\Columns\StudentSurname;
use App\Domain\Student\StudentRepositoryInterface;

final class UpdateStudentUseCase
{
    public function __construct(
        private StudentRepositoryInterface $studentRepository,
        private CourseRepositoryInterface $courseRepository
    ) {
    }

    public function execute(string $id, array $data): void
    {
        $student = $this->studentRepository->findById($id);
        $course = $this->courseRepository->findById($data['courseId']);

        if (!$student || !$course) {
            throw new \Exception("Invalid data");
        }

        $student->setName(new StudentName($data['name']));
        $student->setSurname(new StudentSurname($data['surname']));
        $student->setDni(new StudentDni($data['dni']));
        $student->setMail(new StudentMail($data['mail']));
        $student->setCourse($course);

        $this->studentRepository->save($student);
    }
}