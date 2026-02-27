<?php
declare(strict_types=1);

namespace App\Application\UseCase\Department\DeleteDepartment;

use Exception;
use App\Infrastructure\Persistence\Doctrine\DepartmentRepository;


final class DeleteDepartmentUseCase
{
    public function __construct(
        private DepartmentRepository $departmentRepository
    ) {
    }

    public function execute(string $id): void
    {
        $department = $this->departmentRepository->findById($id);

        if (!$department) {
            throw new Exception("Department not found");
        }

        $this->departmentRepository->remove($department);
    }
}