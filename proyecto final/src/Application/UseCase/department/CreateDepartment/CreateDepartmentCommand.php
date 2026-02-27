<?php
declare(strict_types=1);

namespace App\Application\UseCase\Department\CreateDepartment;

final class CreateDepartmentCommand
{
    public function __construct(
        public string $name
    ) {}
}