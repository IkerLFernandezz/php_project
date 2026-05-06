<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use App\Application\UseCase\Teacher\CreateTeacher\CreateTeacherCommand;
use App\Application\UseCase\Teacher\CreateTeacher\CreateTeacherUseCase;
use App\Application\UseCase\Teacher\DeleteTeacher\DeleteTeacherUseCase;
use App\Application\UseCase\Teacher\UpdateTeacher\UpdateTeacherUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\JsonResponse;
use App\Infrastructure\Persistence\Doctrine\DoctrineDepartmentRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineTeacherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

final class TeacherApiController
{
    private DoctrineTeacherRepository $teacherRepo;
    private DoctrineDepartmentRepository $departmentRepo;
    private CreateTeacherUseCase $createUC;
    private UpdateTeacherUseCase $updateUC;
    private DeleteTeacherUseCase $deleteUC;

    public function __construct(Request $request, EntityManagerInterface $em)
    {
        $this->teacherRepo    = new DoctrineTeacherRepository($em);
        $this->departmentRepo = new DoctrineDepartmentRepository($em);
        $this->createUC = new CreateTeacherUseCase($this->teacherRepo, $this->departmentRepo);
        $this->updateUC = new UpdateTeacherUseCase($this->teacherRepo, $this->departmentRepo);
        $this->deleteUC = new DeleteTeacherUseCase($this->teacherRepo);
    }

    public function index(): void
    {
        $data = array_map(fn($t) => $t->toArray(), $this->teacherRepo->findAll());
        JsonResponse::send($data);
    }

    public function show(string $id): void
    {
        $teacher = $this->teacherRepo->findById($id);
        if (!$teacher) {
            JsonResponse::send(['error' => 'Teacher not found'], 404);
        }
        JsonResponse::send($teacher->toArray());
    }

    public function store(): void
    {
        try {
            $body = $this->getJsonBody();
            $this->createUC->execute(new CreateTeacherCommand(
                $body['name'],
                $body['surname'],
                $body['dni'],
                $body['mail'],
                $body['departmentId']
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
            $this->updateUC->execute($id, $body);
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

    private function getJsonBody(): array
    {
        $raw = file_get_contents('php://input');
        return json_decode($raw, true) ?? [];
    }
}