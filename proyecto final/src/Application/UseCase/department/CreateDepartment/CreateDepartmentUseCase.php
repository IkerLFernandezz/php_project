<?php
declare(strict_types=1);

namespace App\Application\UseCase\Department\CreateDepartment;

use App\Domain\Department\Department;
use App\Domain\Department\Columns\DepartmentId;
use App\Domain\Department\Columns\DepartmentName;
use App\Infrastructure\Persistence\Doctrine\DepartmentRepository;

final class CreateDepartmentUseCase
{
    public function __construct(
        private DepartmentRepository $departmentRepository
    ) {
    }

    public function execute(CreateDepartmentCommand $command): void
    {
        $id = bin2hex(random_bytes(16));

        $department = new Department(
            new DepartmentId($id),
            new DepartmentName($command->name)
        );

        $this->departmentRepository->save($department);
    }
}