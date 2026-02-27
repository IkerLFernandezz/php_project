<?php
declare(strict_types=1);

namespace App\Domain\Subject;

use App\Domain\Subject\Columns\SubjectId;
use App\Domain\Subject\Columns\SubjectName;
use App\Domain\Course\Course;
use App\Domain\Teacher\Teacher;
use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Entity]
#[ORM\Table(name: "subjects")]
final class Subject
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $id;

    #[ORM\Embedded(class: SubjectName::class)]
    private SubjectName $name;

    #[ORM\ManyToOne(targetEntity: Course::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Course $course;

    #[ORM\ManyToOne(targetEntity: Teacher::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Teacher $teacher;

    public function __construct(
        SubjectId $id,
        SubjectName $name,
        Course $course,
        Teacher $teacher
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setCourse($course);
        $this->assignTeacher($teacher);
    }

    public function getId(): SubjectId
    {
        return new SubjectId($this->id);
    }

    public function setId(SubjectId $id): void
    {
        $value = trim($id->value());

        if ($value === '') {
            throw new Exception("Subject id cannot be empty");
        }

        $this->id = $value;
    }

    public function getName(): SubjectName
    {
        return $this->name;
    }

    public function setName(SubjectName $name): void
    {
        if (trim($name->value()) === '') {
            throw new Exception("Subject name cannot be empty");
        }

        $this->name = $name;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getTeacher(): Teacher
    {
        return $this->teacher;
    }

    public function assignTeacher(Teacher $teacher): void
    {
        $this->teacher = $teacher;
    }
}