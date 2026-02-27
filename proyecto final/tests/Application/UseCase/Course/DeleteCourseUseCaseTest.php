<?php
declare(strict_types=1);

namespace Tests\Application\UseCase\Course;

use Tests\Application\UseCase\Course\UseCaseTestCase;
use App\Application\UseCase\Course\DeleteCourse\DeleteCourseUseCase;
use App\Domain\Course\Course;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;
use Exception;

final class DeleteCourseUseCaseTest extends UseCaseTestCase
{
    public function test_it_throws_if_course_not_found(): void
    {
        /** @var CourseRepository&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(CourseRepository::class);

        $repository
            ->method('findById')
            ->willReturn(null);

        $useCase = new DeleteCourseUseCase($repository);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Course not found");

        $useCase->execute('123');
    }

    public function test_it_deletes_course(): void
    {
        $course = $this->createMock(Course::class);

        /** @var CourseRepository&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(CourseRepository::class);

        $repository
            ->method('findById')
            ->willReturn($course);

        $repository
            ->expects($this->once())
            ->method('remove')
            ->with($course);

        $useCase = new DeleteCourseUseCase($repository);

        $useCase->execute('123');
    }
}