<?php
declare(strict_types=1);

namespace Tests\Application\UseCase\Course;

use PHPUnit\Framework\TestCase;

abstract class UseCaseTestCase extends TestCase
{
    protected function mock(string $class)
    {
        return $this->createMock($class);
    }
}