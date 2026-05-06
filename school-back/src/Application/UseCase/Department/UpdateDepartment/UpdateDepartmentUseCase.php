<?php
declare(strict_types=1);

namespace App\Application\UseCase\Department\UpdateDepartment;

use App\Domain\Department\Columns\DepartmentName;
use App\Domain\Department\DepartmentRepositoryInterface;
use Symfony\Component\Console\Exception\RuntimeException;

final class UpdateDepartmentUseCase
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository
    ) {
    }

    public function execute(UpdateDepartmentCommand $command): void
    {
        $department = $this->departmentRepository->findById($command->id);

        if (!$department) {
            throw new RuntimeException("Department not found");
        }

        $department->setName(
            new DepartmentName($command->name)
        );

        $this->departmentRepository->save($department);
    }
}