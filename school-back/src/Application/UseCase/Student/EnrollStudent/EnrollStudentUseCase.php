<?php
declare(strict_types=1);

namespace App\Application\UseCase\Student\EnrollStudent;

use App\Domain\Course\CourseRepositoryInterface;
use App\Domain\Student\StudentRepositoryInterface;
use Exception;

final class EnrollStudentUseCase
{
    public function __construct(
        private StudentRepositoryInterface $studentRepository,
        private CourseRepositoryInterface $courseRepository
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