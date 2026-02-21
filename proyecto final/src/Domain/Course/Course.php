<?php
declare(strict_types=1);

namespace App\Domain\Course;

use App\Domain\Course\Columns\CourseId;
use App\Domain\Course\Columns\CourseName;
use App\Domain\Course\Columns\CourseSchedule;
use Exception;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
final class Course
{
    private CourseId $id;
    private CourseName $name;
    private CourseSchedule $schedule;

    public function __construct(CourseId $id, CourseName $name, CourseSchedule $Schedule)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSchedule($Schedule);
    }

    public function setId(CourseId $id)
    {
        if (empty(trim($id->value()))) {
            throw new Exception("name cannot be empty");
        }
        $this->id = $id;
    }

    public function getId(): CourseId
    {
        return $this->id;
    }

    public function setName(CourseName $name)
    {
        if (empty(trim($name->value()))) {
            throw new Exception("name cannot be empty");
        }
        $this->name = $name;
    }

    public function getName(): CourseName
    {
        return $this->name;
    }

    public function setSchedule(CourseSchedule $schedule)
    {
        $schedule = trim($schedule->value());
        if (empty(trim($schedule))) {
            throw new Exception("schedule cannot be empty");
        }
        if ($schedule === "Matí" || $schedule === "Diurn") {
            $this->schedule = new CourseSchedule($schedule);
        } else {
            throw new Exception("Schedule should be either 'Mati' or 'Diurn'");
        }
    }

    public function getSchedule(): CourseSchedule
    {
        return $this->schedule;
    }
}
