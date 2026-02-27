<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Application\UseCase\Course\CreateCourse\CreateCourseCommand;
use App\Application\UseCase\Course\CreateCourse\CreateCourseUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Helpers\ViewHelper;
use App\Application\UseCase\Course\UpdateCourse\UpdateCourseUseCase;
use App\Application\UseCase\Course\DeleteCourse\DeleteCourseUseCase;
use App\Application\UseCase\Course\UpdateCourse\UpdateCourseCommand;
use App\Infrastructure\Persistence\Doctrine\DoctrineCourseRepository;

final class CoursesController
{
    private $courseRepository;
    private $createUseCase;
    private $updateUseCase;
    private $deleteUseCase;

    public function __construct(Request $request)
    {
        $doctrineBootstrap = require __DIR__ . '/../../config/doctrine.php';
        $em = $doctrineBootstrap();

        $this->courseRepository = new DoctrineCourseRepository($em);

        $this->createUseCase = new CreateCourseUseCase($this->courseRepository);
        $this->updateUseCase = new UpdateCourseUseCase($this->courseRepository);
        $this->deleteUseCase = new DeleteCourseUseCase($this->courseRepository);
    }

    public function index(): void
    {
        $courses = $this->courseRepository->findAll();

        ViewHelper::render('courses', [
            'courses' => $courses
        ]);
    }

    public function createForm(): void
    {
        ViewHelper::render('courses/create');
    }

    public function store(): void
    {
        try {

            $command = new CreateCourseCommand(
                $_POST['name'],
                $_POST['schedule']
            );

            $this->createUseCase->execute($command);

            header('Location: /courses');
            exit;

        } catch (\Throwable $e) {
            ViewHelper::render('courses/create', ['error' => $e->getMessage()]);
        }
    }

    public function editForm(string $id): void
    {
        $course = $this->courseRepository->findById($id);

        ViewHelper::render('courses/edit', ['course' => $course]);
    }

    public function update(string $id): void
    {
        try {

            $command = new UpdateCourseCommand(
                $id,
                $_POST['name'],
                $_POST['schedule']
            );

            $this->updateUseCase->execute($command);

            header('Location: /courses');
            exit;

        } catch (\Throwable $e) {
            $course = $this->courseRepository->findById($id);

            ViewHelper::render('courses/edit', [
                'course' => $course,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(string $id): void
    {
        $this->deleteUseCase->execute($id);

        header('Location: /courses');
        exit;
    }
}