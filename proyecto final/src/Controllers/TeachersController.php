<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Application\UseCase\Teacher\CreateTeacher\CreateTeacherCommand;
use App\Application\UseCase\Teacher\CreateTeacher\CreateTeacherUseCase;
use App\Application\UseCase\Teacher\DeleteTeacher\DeleteTeacherUseCase;
use App\Application\UseCase\Teacher\UpdateTeacher\UpdateTeacherUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Helpers\ViewHelper;
use App\Infrastructure\Persistence\Doctrine\DoctrineDepartmentRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineTeacherRepository;

final class TeachersController
{
    private $teacherRepository;
    private $departmentRepository;
    private $createUseCase;
    private $updateUseCase;
    private $deleteUseCase;

    public function __construct(Request $request)
    {
        $doctrineBootstrap = require __DIR__ . '/../../config/doctrine.php';
        $em = $doctrineBootstrap();

        $this->teacherRepository = new DoctrineTeacherRepository($em);
        $this->departmentRepository = new DoctrineDepartmentRepository($em);

        $this->createUseCase = new CreateTeacherUseCase(
            $this->teacherRepository,
            $this->departmentRepository
        );

        $this->updateUseCase = new UpdateTeacherUseCase(
            $this->teacherRepository,
            $this->departmentRepository
        );

        $this->deleteUseCase = new DeleteTeacherUseCase(
            $this->teacherRepository
        );
    }

    public function index(): void
    {
        $teachers = $this->teacherRepository->findAll();

        ViewHelper::render('teachers', [
            'teachers' => $teachers
        ]);
    }

    public function createForm(): void
    {
        $departments = $this->departmentRepository->findAll();

        ViewHelper::render('teachers/create', [
            'departments' => $departments
        ]);
    }

    public function store(): void
    {
        try {

            $command = new CreateTeacherCommand(
                $_POST['name'],
                $_POST['surname'],
                $_POST['dni'],
                $_POST['mail'],
                $_POST['departmentId']
            );

            $this->createUseCase->execute($command);

            header('Location: /teachers');
            exit;

        } catch (\Throwable $e) {

            $departments = $this->departmentRepository->findAll();

            ViewHelper::render('teachers/create', [
                'departments' => $departments,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function editForm(string $id): void
    {
        $teacher = $this->teacherRepository->findById($id);
        $departments = $this->departmentRepository->findAll();

        ViewHelper::render('teachers/edit', [
            'teacher' => $teacher,
            'departments' => $departments
        ]);
    }

    public function update(string $id): void
    {
        try {

            $this->updateUseCase->execute($id, $_POST);

            header('Location: /teachers');
            exit;

        } catch (\Throwable $e) {

            $teacher = $this->teacherRepository->findById($id);
            $departments = $this->departmentRepository->findAll();

            ViewHelper::render('teachers/edit', [
                'teacher' => $teacher,
                'departments' => $departments,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(string $id): void
    {
        $this->deleteUseCase->execute($id);

        header('Location: /teachers');
        exit;
    }
}