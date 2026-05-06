<?php
declare(strict_types=1);

namespace App\Application\UseCase\Course\DeleteCourse;

use App\Domain\Course\CourseRepositoryInterface;
use Exception;

final class DeleteCourseUseCase
{
    public function __construct(
        private CourseRepositoryInterface $courseRepository
    ) {
    }

    public function execute(string $id): void
    {
        $course = $this->courseRepository->findById($id);

        if (!$course) {
            throw new Exception("Course not found");
        }

        $this->courseRepository->remove($course);
    }
}