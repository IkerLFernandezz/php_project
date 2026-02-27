<?php
declare(strict_types=1);

namespace App\Domain\Department;

use App\Domain\Department\Columns\DepartmentId;
use App\Domain\Department\Columns\DepartmentName;
use App\Domain\Teacher\Teacher;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Entity]
#[ORM\Table(name: "departments")]
final class Department
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $id;

    #[ORM\Embedded(class: DepartmentName::class, columnPrefix: false)]
    private DepartmentName $name;

    #[ORM\OneToMany(
        mappedBy: "department",
        targetEntity: Teacher::class
    )]

    private Collection $teachers;

    public function __construct(
        DepartmentId $id,
        DepartmentName $name
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->teachers = new ArrayCollection();
    }

    public function getId(): DepartmentId
    {
        return new DepartmentId($this->id);
    }

    public function setId(DepartmentId $id): void
    {
        $value = trim($id->value());

        if ($value === '') {
            throw new Exception("id cannot be empty");
        }

        $this->id = $value;
    }

    public function getName(): DepartmentName
    {
        return $this->name;
    }

    public function setName(DepartmentName $name): void
    {
        if (empty(trim($name->value()))) {
            throw new Exception("name cannot be empty");
        }

        $this->name = $name;
    }

    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): void
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers[] = $teacher;
            $teacher->setDepartment($this);
        }
    }
}