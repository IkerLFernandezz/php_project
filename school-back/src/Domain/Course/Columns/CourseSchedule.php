<?php
declare(strict_types=1);

namespace App\Domain\Course\Columns;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Embeddable]
final class CourseSchedule
{
    #[ORM\Column(type: "string", length: 50)]
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