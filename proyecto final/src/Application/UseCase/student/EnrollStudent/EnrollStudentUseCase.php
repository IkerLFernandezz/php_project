<?php
declare(strict_types=1);

namespace App\Application\UseCase\Student\EnrollStudent;

use App\Infrastructure\Persistence\Doctrine\StudentRepository;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;
use Exception;

final class EnrollStudentUseCase
{
    public function __construct(
        private StudentRepository $studentRepository,
        private CourseRepository $courseRepository
    ) {
    }

    public function execute(EnrollStudentCommand $command): void
    {
        $student = $this->studentRepository->findById($command->studentId);
        $course = $this->courseRepository->findById($command->courseId);

        if (!$student) {
            throw new Exception("Student not found");
        }

        if (!$course) {
            throw new Exception("Course not found");
        }

        $student->setCourse($course);

        $this->studentRepository->save($student);
    }
}