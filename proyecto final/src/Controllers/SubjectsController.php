<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Application\UseCase\Subject\DeleteSubject\DeleteSubjectUseCase;
use App\Application\UseCase\Subject\CreateSubject\CreateSubjectUseCase;
use App\Application\UseCase\Subject\UpdateSubject\UpdateSubjectUseCase;
use App\Application\UseCase\Subject\CreateSubject\CreateSubjectCommand;
use App\Application\UseCase\Subject\UpdateSubject\UpdateSubjectCommand;
use App\Application\UseCase\Subject\AssignTeacher\AssignTeacherToSubjectCommand;
use App\Application\UseCase\Subject\AssignTeacher\AssignTeacherToSubjectUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Helpers\ViewHelper;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineCourseRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineSubjectRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineTeacherRepository;
use App\Infrastructure\Persistence\Doctrine\SubjectRepository;
use App\Infrastructure\Persistence\Doctrine\TeacherRepository;

final class SubjectsController
{
    private CreateSubjectUseCase $createUseCase;
    private UpdateSubjectUseCase $updateUseCase;
    private DeleteSubjectUseCase $deleteUseCase;
    private SubjectRepository $subjectRepository;
    private TeacherRepository $teacherRepository;
    private CourseRepository $courseRepository;
    private $assignTeacherUseCase;

    public function __construct(Request $request)
    {
        $doctrineBootstrap = require __DIR__ . '/../../config/doctrine.php';
        $em = $doctrineBootstrap();

        $this->subjectRepository = new DoctrineSubjectRepository($em);
        $this->teacherRepository = new DoctrineTeacherRepository($em);
        $this->courseRepository = new DoctrineCourseRepository($em);

        $courseRepo = new DoctrineCourseRepository($em);
        $teacherRepo = new DoctrineTeacherRepository($em);

        $this->createUseCase = new CreateSubjectUseCase(
            $this->subjectRepository,
            $courseRepo,
            $teacherRepo
        );

        $this->updateUseCase = new UpdateSubjectUseCase(
            $this->subjectRepository,
            $teacherRepo
        );

        $this->deleteUseCase = new DeleteSubjectUseCase(
            $this->subjectRepository
        );

        $this->assignTeacherUseCase = new AssignTeacherToSubjectUseCase(
            $this->subjectRepository,
            $this->teacherRepository
        );
    }

    public function createForm(): void
    {
        $teachers = $this->teacherRepository->findAll();
        $courses = $this->courseRepository->findAll();

        $selectedCourse = $_GET['course'] ?? null;

        ViewHelper::render(
            'subjects/create',
            [
                'teachers' => $teachers,
                'courses' => $courses,
                'selectedCourse' => $selectedCourse
            ]
        );
    }

    public function store(): void
    {
        try {

            $command = new CreateSubjectCommand(
                $_POST['name'],
                $_POST['course_id'],
                $_POST['teacher_id']
            );

            $this->createUseCase->execute($command);

            header('Location: /courses');
            exit;

        } catch (\Throwable $e) {

            $teachers = $this->teacherRepository->findAll();

            ViewHelper::render(
                'subjects/create',
                [
                    'teachers' => $teachers,
                    'error' => $e->getMessage()
                ]
            );
        }
    }

    public function assignTeacher(string $id): void
    {
        try {

            $command = new AssignTeacherToSubjectCommand(
                $id,
                $_POST['teacherId']
            );

            $this->assignTeacherUseCase->execute($command);

            header('Location: /courses');
            exit;

        } catch (\Throwable $e) {

            header('Location: /courses');
            exit;
        }
    }
    public function editForm(string $id): void
    {
        $subject = $this->subjectRepository->findById($id);
        $teachers = $this->teacherRepository->findAll();

        ViewHelper::render(
            'subjects/edit',
            [
                'subject' => $subject,
                'teachers' => $teachers
            ]
        );
    }

    public function update(string $id): void
    {
        try {

            $command = new UpdateSubjectCommand(
                $id,
                $_POST['name'],
                $_POST['teacher_id']
            );

            $this->updateUseCase->execute($command);

            header('Location: /courses');
            exit;

        } catch (\Throwable $e) {

            $subject = $this->subjectRepository->findById($id);
            $teachers = $this->teacherRepository->findAll();

            ViewHelper::render(
                'subjects/edit',
                [
                    'subject' => $subject,
                    'teachers' => $teachers,
                    'error' => $e->getMessage()
                ]
            );
        }
    }

    public function delete(string $id): void
    {
        $this->deleteUseCase->execute($id);

        header('Location: /courses');
        exit;
    }
}