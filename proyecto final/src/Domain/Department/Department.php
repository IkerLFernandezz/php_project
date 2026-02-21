<?php
declare(strict_types=1);

namespace App\Domain\Department;

use App\Domain\Department\Columns\DepartmentName;
use App\Domain\Department\Columns\DepartmentId;
use Exception;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
final class Department
{
    private DepartmentId $id;
    private DepartmentName $name;

    public function __construct(DepartmentId $id, DepartmentName $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    public function setId(DepartmentId $id)
    {
        if (empty(trim($id->value()))) {
            throw new Exception("id cannot be empty");
        }
        $this->id = $id;
    }
    public function getId(): DepartmentId
    {
        return $this->id;
    }

    public function setName(DepartmentName $name)
    {
        if (empty(trim($name->value()))) {
            throw new Exception("name cannot be empty");
        }
        $this->name = $name;
    }

    public function getName(): DepartmentName
    {
        return $this->name;
    }

}