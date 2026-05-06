<?php
declare(strict_types=1);

namespace App\Application\UseCase\Course\CreateCourse;

use App\Domain\Course\Course;
use App\Domain\Course\CourseRepositoryInterface;
use App\Domain\Course\Columns\CourseId;
use App\Domain\Course\Columns\CourseName;
use App\Domain\Course\Columns\CourseSchedule;

final class CreateCourseUseCase
{
    public function __construct(
        private CourseRepositoryInterface $courseRepository
    ) {
    }

    public function execute(CreateCourseCommand $command): void
    {
        $id = bin2hex(random_bytes(16));

        $course = new Course(
            new CourseId($id),
            new CourseName($command->name),
            new CourseSchedule($command->schedule)
        );

        $this->courseRepository->save($course);
    }
}