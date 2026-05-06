<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use App\Application\UseCase\Subject\AssignTeacher\AssignTeacherToSubjectCommand;
use App\Application\UseCase\Subject\AssignTeacher\AssignTeacherToSubjectUseCase;
use App\Application\UseCase\Subject\CreateSubject\CreateSubjectCommand;
use App\Application\UseCase\Subject\CreateSubject\CreateSubjectUseCase;
use App\Application\UseCase\Subject\DeleteSubject\DeleteSubjectUseCase;
use App\Application\UseCase\Subject\UpdateSubject\UpdateSubjectCommand;
use App\Application\UseCase\Subject\UpdateSubject\UpdateSubjectUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\JsonResponse;
use App\Infrastructure\Persistence\Doctrine\DoctrineCourseRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineSubjectRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineTeacherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

final class SubjectApiController
{
    private DoctrineSubjectRepository $subjectRepo;
    private DoctrineCourseRepository $courseRepo;
    private DoctrineTeacherRepository $teacherRepo;
    private CreateSubjectUseCase $createUC;
    private UpdateSubjectUseCase $updateUC;
    private DeleteSubjectUseCase $deleteUC;
    private AssignTeacherToSubjectUseCase $assignUC;

    public function __construct(Request $request, EntityManagerInterface $em)
    {
        $this->subjectRepo = new DoctrineSubjectRepository($em);
        $this->courseRepo = new DoctrineCourseRepository($em);
        $this->teacherRepo = new DoctrineTeacherRepository($em);
        $this->createUC = new CreateSubjectUseCase($this->subjectRepo, $this->courseRepo, $this->teacherRepo);
        $this->updateUC = new UpdateSubjectUseCase($this->subjectRepo, $this->teacherRepo);
        $this->deleteUC = new DeleteSubjectUseCase($this->subjectRepo);
        $this->assignUC = new AssignTeacherToSubjectUseCase($this->subjectRepo, $this->teacherRepo);
    }

    public function index(): void
    {
        $data = array_map(fn($s) => $s->toArray(), $this->subjectRepo->findAll());
        JsonResponse::send($data);
    }

    public function show(string $id): void
    {
        $subject = $this->subjectRepo->findById($id);
        if (!$subject) {
            JsonResponse::send(['error' => 'Subject not found'], 404);
        }
        JsonResponse::send($subject->toArray());
    }

    public function store(): void
    {
        try {
            $body = $this->getJsonBody();
            $this->createUC->execute(new CreateSubjectCommand(
                $body['name'],
                $body['courseId'],
                $body['teacherId']
            ));
            JsonResponse::send(['status' => 'created'], 201);
        } catch (Throwable $e) {
            JsonResponse::send(['error' => $e->getMessage()], 400);
        }
    }

    public function update(string $id): void
    {
        try {
            $body = $this->getJsonBody();
            $this->updateUC->execute(new UpdateSubjectCommand(
                $id,
                $body['name'],
                $body['teacherId']
            ));
            JsonResponse::send(['status' => 'updated']);
        } catch (Throwable $e) {
            JsonResponse::send(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(string $id): void
    {
        try {
            $this->deleteUC->execute($id);
            JsonResponse::send(['status' => 'deleted']);
        } catch (Throwable $e) {
            JsonResponse::send(['error' => $e->getMessage()], 400);
        }
    }

    public function assignTeacher(string $id): void
    {
        try {
            $body = $this->getJsonBody();
            $this->assignUC->execute(new AssignTeacherToSubjectCommand(
                $id,
                $body['teacherId']
            ));
            JsonResponse::send(['status' => 'teacher assigned']);
        } catch (Throwable $e) {
            JsonResponse::send(['error' => $e->getMessage()], 400);
        }
    }

    private function getJsonBody(): array
    {
        $raw = file_get_contents('php://input');
        return json_decode($raw, true) ?? [];
    }
}