<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Application\UseCase\Department\CreateDepartment\CreateDepartmentCommand;
use App\Application\UseCase\Department\CreateDepartment\CreateDepartmentUseCase;
use App\Application\UseCase\Department\DeleteDepartment\DeleteDepartmentUseCase;
use App\Application\UseCase\Department\UpdateDepartment\UpdateDepartmentCommand;
use App\Application\UseCase\Department\UpdateDepartment\UpdateDepartmentUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Helpers\ViewHelper;
use App\Infrastructure\Persistence\Doctrine\DoctrineDepartmentRepository;

final class DepartmentsController
{
    private $departmentRepository;
    private $createUseCase;
    private $updateUseCase;
    private $deleteUseCase;

    public function __construct(Request $request)
    {
        $doctrineBootstrap = require __DIR__ . '/../../config/doctrine.php';
        $em = $doctrineBootstrap();

        $this->departmentRepository = new DoctrineDepartmentRepository($em);

        $this->createUseCase = new CreateDepartmentUseCase(
            $this->departmentRepository
        );

        $this->updateUseCase = new UpdateDepartmentUseCase(
            $this->departmentRepository
        );

        $this->deleteUseCase = new DeleteDepartmentUseCase(
            $this->departmentRepository
        );
    }

    public function index(): void
    {
        $departments = $this->departmentRepository->findAll();

        ViewHelper::render('departments', [
            'departments' => $departments
        ]);
    }

    public function createForm(): void
    {
        ViewHelper::render('departments/create');
    }

    public function store(): void
    {
        try {

            $command = new CreateDepartmentCommand(
                $_POST['name']
            );

            $this->createUseCase->execute($command);

            header('Location: /departments');
            exit;

        } catch (\Throwable $e) {

            ViewHelper::render('departments/create', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function editForm(string $id): void
    {
        $department = $this->departmentRepository->findById($id);

        ViewHelper::render('departments/edit', [
            'department' => $department
        ]);
    }

    public function update(string $id): void
    {
        try {

            $command = new UpdateDepartmentCommand(
                $id,
                $_POST['name']
            );
            $this->updateUseCase->execute($command);

            header('Location: /departments');
            exit;

        } catch (\Throwable $e) {

            $department = $this->departmentRepository->findById($id);

            ViewHelper::render('departments/edit', [
                'department' => $department,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(string $id): void
    {
        $this->deleteUseCase->execute($id);

        header('Location: /departments');
        exit;
    }
}