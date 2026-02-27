<?php
declare(strict_types=1);

namespace App\Application\UseCase\Course\UpdateCourse;

use App\Domain\Course\Columns\CourseName;
use App\Domain\Course\Columns\CourseSchedule;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;
use Exception;

final class UpdateCourseUseCase
{
    public function __construct(
        private CourseRepository $courseRepository
    ) {
    }

    public function execute(UpdateCourseCommand $command): void
    {
        $course = $this->courseRepository->findById($command->id);

        if (!$course) {
            throw new Exception("Course not found");
        }

        $course->setName(new CourseName($command->name));
        $course->setSchedule(new CourseSchedule($command->schedule));

        $this->courseRepository->save($course);
    }
}