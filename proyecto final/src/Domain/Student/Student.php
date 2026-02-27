<?php
declare(strict_types=1);

namespace App\Domain\Student;

use App\Domain\Course\Columns\CourseId;
use App\Domain\Course\Course;
use App\Domain\Student\Columns\StudentId;
use App\Domain\Student\Columns\StudentName;
use App\Domain\Student\Columns\StudentSurname;
use App\Domain\Student\Columns\StudentDni;
use App\Domain\Student\Columns\StudentMail;
use Doctrine\ORM\Mapping as ORM;
use Exception;


#[ORM\Entity]
#[ORM\Table(name: "students")]
final class Student
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $id;

    #[ORM\Embedded(class: StudentName::class, columnPrefix: false)]
    private StudentName $name;

    #[ORM\Embedded(class: StudentSurname::class, columnPrefix: false)]
    private StudentSurname $surname;

    #[ORM\Embedded(class: StudentDni::class, columnPrefix: false)]
    private StudentDni $dni;

    #[ORM\Embedded(class: StudentMail::class, columnPrefix: false)]
    private StudentMail $mail;

    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: "students")]
    #[ORM\JoinColumn(nullable: false)]
    private Course $course;

    public function __construct(StudentId $id, StudentName $name, StudentSurname $surname, Course $course, StudentDni $dni, StudentMail $mail)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setCourse($course);
        $this->setDni($dni);
        $this->setMail($mail);
    }

    public function getId(): StudentId
    {
        return new StudentId($this->id);
    }

    public function setId(StudentId $id)
    {

        $value = trim($id->value());

        if ($value === '') {
            throw new Exception("id cannot be empty");
        }

        $this->id = $value;

    }

    public function getName(): StudentName
    {
        return $this->name;
    }

    public function setName(StudentName $name)
    {
        if (empty(trim($name->value()))) {
            throw new Exception("name cannot be empty");
        }
        $this->name = $name;
    }

    public function getSurname(): StudentSurname
    {
        return $this->surname;
    }

    public function setSurname(StudentSurname $surname)
    {
        if (empty(trim($surname->value()))) {
            throw new Exception("surname cannot be empty");
        }
        $this->surname = $surname;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course)
    {
        $this->course = $course;
    }

    public function getDni(): StudentDni
    {
        return $this->dni;
    }

    public function setDni(StudentDni $dni)
    {
        if (empty(trim($dni->value()))) {
            throw new Exception("dni cannot be empty");
        }
        $this->dni = $dni;
    }

    public function getMail(): StudentMail
    {
        return $this->mail;
    }

    public function setMail(StudentMail $mail)
    {
        if (empty(trim($mail->value()))) {
            throw new Exception("mail cannot be empty");
        }
        $this->mail = $mail;
    }
}