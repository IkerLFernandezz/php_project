<?php
declare(strict_types=1);

namespace App\Application\UseCase\Department\UpdateDepartment;

final class UpdateDepartmentCommand
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
    ) {
    }
}