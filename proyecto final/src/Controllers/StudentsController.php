<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Application\UseCase\Student\CreateStudent\CreateStudentCommand;
use App\Application\UseCase\Student\CreateStudent\CreateStudentUseCase;
use App\Application\UseCase\Student\DeleteStudent\DeleteStudentUseCase;
use App\Application\UseCase\Student\UpdateStudent\UpdateStudentUseCase;
use App\Application\UseCase\Student\EnrollStudent\EnrollStudentCommand;
use App\Application\UseCase\Student\EnrollStudent\EnrollStudentUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Helpers\ViewHelper;
use App\Infrastructure\Persistence\Doctrine\DoctrineStudentRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineCourseRepository;

final class StudentsController
{
    private $studentRepository;
    private $courseRepository;
    private $createUseCase;
    private $updateUseCase;
    private $deleteUseCase;
    private $enrollUseCase;
    public function __construct(Request $request)
    {
        $doctrineBootstrap = require __DIR__ . '/../../config/doctrine.php';
        $em = $doctrineBootstrap();

        $this->studentRepository = new DoctrineStudentRepository($em);
        $this->courseRepository = new DoctrineCourseRepository($em);

        $this->createUseCase = new CreateStudentUseCase(
            $this->studentRepository,
            $this->courseRepository
        );

        $this->updateUseCase = new UpdateStudentUseCase(
            $this->studentRepository,
            $this->courseRepository
        );

        $this->deleteUseCase = new DeleteStudentUseCase(
            $this->studentRepository
        );

        $this->enrollUseCase = new EnrollStudentUseCase(
            $this->studentRepository,
            $this->courseRepository
        );
    }

    public function index(): void
    {
        ViewHelper::render('students', [
            'students' => $this->studentRepository->findAll(),
            'courses' => $this->courseRepository->findAll()
        ]);
    }

    public function createForm(): void
    {
        ViewHelper::render('students/create', [
            'courses' => $this->courseRepository->findAll()
        ]);
    }

    public function enroll(string $id): void
    {
        try {

            $command = new EnrollStudentCommand(
                $id,
                $_POST['courseId']
            );

            $this->enrollUseCase->execute($command);

            header('Location: /students');
            exit;

        } catch (\Throwable $e) {

            $students = $this->studentRepository->findAll();
            $courses = $this->courseRepository->findAll();

            ViewHelper::render('students', [
                'students' => $students,
                'courses' => $courses,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store(): void
    {
        try {

            $command = new CreateStudentCommand(
                $_POST['name'],
                $_POST['surname'],
                $_POST['dni'],
                $_POST['mail'],
                $_POST['courseId']
            );

            $this->createUseCase->execute($command);

            header('Location: /students');
            exit;

        } catch (\Throwable $e) {

            ViewHelper::render('students/create', [
                'courses' => $this->courseRepository->findAll(),
                'error' => $e->getMessage()
            ]);
        }
    }

    public function editForm(string $id): void
    {
        ViewHelper::render('students/edit', [
            'student' => $this->studentRepository->findById($id),
            'courses' => $this->courseRepository->findAll()
        ]);
    }

    public function update(string $id): void
    {
        try {

            $this->updateUseCase->execute($id, $_POST);

            header('Location: /students');
            exit;

        } catch (\Throwable $e) {

            ViewHelper::render('students/edit', [
                'student' => $this->studentRepository->findById($id),
                'courses' => $this->courseRepository->findAll(),
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(string $id): void
    {
        $this->deleteUseCase->execute($id);
        header('Location: /students');
        exit;
    }
}