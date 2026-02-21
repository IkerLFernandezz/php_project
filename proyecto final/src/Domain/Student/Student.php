<?php
declare(strict_types=1);

namespace App\Domain\Student;

use App\Domain\Course\Columns\CourseId;
use App\Domain\Student\Columns\StudentId;
use App\Domain\Student\Columns\StudentName;
use App\Domain\Student\Columns\StudentSurname;
use App\Domain\Student\Columns\StudentLicense;
use App\Domain\Student\Columns\StudentMail;
use Doctrine\ORM\Mapping\Entity;
use Exception;

#[Entity]
final class Student
{
    private StudentId $id;
    private StudentName $name;
    private StudentSurname $surname;
    private CourseId $course;
    private StudentLicense $license;
    private StudentMail $mail;

    public function __construct(StudentId $id, StudentName $name, StudentSurname $surname, CourseId $course, StudentLicense $license, StudentMail $mail)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setCourse($course);
        $this->setLicense($license);
        $this->setMail($mail);
    }

    public function getId(): StudentId
    {
        return $this->id;
    }

    public function setId(StudentId $id)
    {
        if (empty(trim($id->value()))) {
            throw new Exception("id cannot be empty");
        }
        $this->id = $id;
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

    public function getCourse(): CourseId
    {
        return $this->course;
    }

    public function setCourse(CourseId $course)
    {
        if (empty(trim($course->value()))) {
            throw new Exception("surname cannot be empty");
        }
        $this->course = $course;
    }

    public function getLicense(): StudentLicense
    {
        return $this->license;
    }

    public function setLicense(StudentLicense $license)
    {
        if (empty(trim($license->value()))) {
            throw new Exception("license cannot be empty");
        }
        $this->license = $license;

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