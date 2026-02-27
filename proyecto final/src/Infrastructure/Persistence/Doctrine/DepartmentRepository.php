<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Department\Department;

interface DepartmentRepository
{
    public function save(Department $department): void;

    public function findById(string $id): ?Department;

    public function findAll(): array;

    public function remove(Department $department): void;
}