<?php
declare(strict_types=1);

namespace App\Domain\Course\Columns;

final class CourseSchedule
{
    private string $schedule;

    public function __construct(string $schedule)
    {
        $this->schedule = $schedule;
    }

    public function value(): string
    {
        return $this->schedule;
    }
}