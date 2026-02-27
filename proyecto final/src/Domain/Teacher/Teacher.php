<?php
declare(strict_types=1);

namespace App\Domain\Teacher;

use App\Domain\Department\Department;
use App\Domain\Teacher\Columns\TeacherId;
use App\Domain\Teacher\Columns\TeacherName;
use App\Domain\Teacher\Columns\TeacherSurname;
use App\Domain\Teacher\Columns\TeacherDni;
use App\Domain\Teacher\Columns\TeacherMail;
use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Entity]
#[ORM\Table(name: "teachers")]
final class Teacher
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $id;

    #[ORM\Embedded(class: TeacherName::class, columnPrefix: false)]
    private TeacherName $name;

    #[ORM\Embedded(class: TeacherSurname::class, columnPrefix: false)]
    private TeacherSurname $surname;

    #[ORM\Embedded(class: TeacherDni::class, columnPrefix: false)]
    private TeacherDni $dni;

    #[ORM\Embedded(class: TeacherMail::class, columnPrefix: false)]
    private TeacherMail $mail;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: "teachers")]
    #[ORM\JoinColumn(nullable: false)]
    private Department $department;

    public function __construct(
        TeacherId $id,
        TeacherName $name,
        TeacherSurname $surname,
        TeacherDni $dni,
        TeacherMail $mail
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setDni($dni);
        $this->setMail($mail);

    }

    public function getId(): TeacherId
    {
        return new TeacherId($this->id);
    }

    public function setId(TeacherId $id): void
    {
        $value = trim($id->value());

        if ($value === '') {
            throw new Exception("id cannot be empty");
        }

        $this->id = $value;

    }

    public function getName(): TeacherName
    {
        return $this->name;
    }

    public function setName(TeacherName $name): void
    {
        if (empty(trim($name->value()))) {
            throw new Exception("name cannot be empty");
        }

        $this->name = $name;
    }

    public function getSurname(): TeacherSurname
    {
        return $this->surname;
    }

    public function setSurname(TeacherSurname $surname): void
    {
        if (empty(trim($surname->value()))) {
            throw new Exception("surname cannot be empty");
        }

        $this->surname = $surname;
    }

    public function getDni(): TeacherDni
    {
        return $this->dni;
    }

    public function setDni(TeacherDni $dni): void
    {
        if (empty(trim($dni->value()))) {
            throw new Exception("dni cannot be empty");
        }

        $this->dni = $dni;
    }

    public function getMail(): TeacherMail
    {
        return $this->mail;
    }

    public function setMail(TeacherMail $mail): void
    {
        if (empty(trim($mail->value()))) {
            throw new Exception("mail cannot be empty");
        }

        $this->mail = $mail;
    }

    public function getDepartment(): Department
    {
        return $this->department;
    }

    public function setDepartment(Department $department): void
    {
        $this->department = $department;
    }
}