<?php
declare(strict_types=1);

namespace App\Domain\Department;

use App\Domain\Department\Department;

Interface DepartmentRepositoryInterface
{
    public function save(Department $department): void;

    public function findById(string $id): ?Department;

    public function findAll(): array;

    public function remove(Department $department): void;
}