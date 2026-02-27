<?php
declare(strict_types=1);

namespace App\Domain\Course;

use App\Domain\Course\Columns\CourseId;
use App\Domain\Course\Columns\CourseName;
use App\Domain\Course\Columns\CourseSchedule;
use App\Domain\Student\Student;
use App\Domain\Subject\Subject;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Entity]
#[ORM\Table(name: "courses")]
final class Course
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $id;

    #[ORM\Embedded(class: CourseName::class, columnPrefix: false)]
    private CourseName $name;

    #[ORM\Embedded(class: CourseSchedule::class, columnPrefix: false)]
    private CourseSchedule $schedule;

    #[ORM\OneToMany(
        mappedBy: "course",
        targetEntity: Student::class
    )]
    private Collection $students;

    #[ORM\OneToMany(
        mappedBy: "course",
        targetEntity: Subject::class
    )]
    private Collection $subjects;



    public function __construct(
        CourseId $id,
        CourseName $name,
        CourseSchedule $schedule,

    ) {
        $this->students = new ArrayCollection();
        $this->setId($id);
        $this->setName($name);
        $this->setSchedule($schedule);

    }

    public function getId(): CourseId
    {
        return new CourseId($this->id);
    }

    public function setId(CourseId $id): void
    {
        $value = trim($id->value());

        if ($value === '') {
            throw new Exception("id cannot be empty");
        }

        $this->id = $value;
    }

    public function getName(): CourseName
    {
        return $this->name;
    }

    public function setName(CourseName $name): void
    {
        if (empty(trim($name->value()))) {
            throw new Exception("name cannot be empty");
        }

        $this->name = $name;
    }

    public function getSchedule(): CourseSchedule
    {
        return $this->schedule;
    }

    public function setSchedule(CourseSchedule $schedule): void
    {
        $value = trim($schedule->value());

        if ($value === '') {
            throw new Exception("schedule cannot be empty");
        }

        if ($value !== "Matí" && $value !== "Diurn") {
            throw new Exception("Schedule must be 'Matí' or 'Diurn'");
        }

        $this->schedule = new CourseSchedule($value);
    }

    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): void
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setCourse($this);
        }
    }

    public function removeStudent(Student $student): void
    {
        $this->subjects->removeElement($student);
    }

    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): void
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->setCourse($this);
        }
    }
}