<?php
declare(strict_types=1);

namespace Tests\Application\UseCase\Course;

use Tests\Application\UseCase\Course\UseCaseTestCase;
use App\Application\UseCase\Course\CreateCourse\CreateCourseCommand;
use App\Application\UseCase\Course\CreateCourse\CreateCourseUseCase;
use App\Domain\Course\Course;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;

final class CreateCourseUseCaseTest extends UseCaseTestCase
{
    public function test_it_creates_a_course(): void
    {
        /** @var CourseRepository&\PHPUnit\Framework\MockObject\MockObject $repository */
        $repository = $this->createMock(CourseRepository::class);

        $repository
            ->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Course::class));

        $useCase = new CreateCourseUseCase($repository);

        $command = new CreateCourseCommand(
            name: 'Math',
            schedule: 'Morning'
        );

        $useCase->execute($command);
    }
}