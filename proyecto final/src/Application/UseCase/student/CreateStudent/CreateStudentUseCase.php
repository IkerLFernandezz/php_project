<?php
declare(strict_types=1);

namespace App\Application\UseCase\Student\CreateStudent;

use App\Domain\Student\Columns\StudentDni;
use App\Domain\Student\Columns\StudentId;
use App\Domain\Student\Columns\StudentMail;
use App\Domain\Student\Columns\StudentName;
use App\Domain\Student\Columns\StudentSurname;
use App\Domain\Student\Student;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;
use App\Infrastructure\Persistence\Doctrine\StudentRepository;

final class CreateStudentUseCase
{
    public function __construct(
        private StudentRepository $studentRepository,
        private CourseRepository $courseRepository
    ) {
    }

    public function execute(CreateStudentCommand $command): void
    {
        $course = $this->courseRepository->findById($command->courseId);

        if (!$course) {
            throw new \Exception("Course not found");
        }

        $student = new Student(
            new StudentId(bin2hex(random_bytes(16))),
            new StudentName($command->name),
            new StudentSurname($command->surname),
            $course,
            new StudentDni($command->dni),
            new StudentMail($command->mail)
        );

        $this->studentRepository->save($student);
    }
}