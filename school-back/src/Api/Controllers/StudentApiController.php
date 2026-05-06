<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use App\Application\UseCase\Student\CreateStudent\CreateStudentCommand;
use App\Application\UseCase\Student\CreateStudent\CreateStudentUseCase;
use App\Application\UseCase\Student\DeleteStudent\DeleteStudentUseCase;
use App\Application\UseCase\Student\UpdateStudent\UpdateStudentUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\JsonResponse;
use App\Infrastructure\Persistence\Doctrine\DoctrineCourseRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineStudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

final class StudentApiController
{
    private DoctrineStudentRepository $studentRepo;
    private DoctrineCourseRepository $courseRepo;
    private CreateStudentUseCase $createUC;
    private UpdateStudentUseCase $updateUC;
    private DeleteStudentUseCase $deleteUC;

    public function __construct(Request $request, EntityManagerInterface $em)
    {
        $this->studentRepo = new DoctrineStudentRepository($em);
        $this->courseRepo  = new DoctrineCourseRepository($em);
        $this->createUC    = new CreateStudentUseCase($this->studentRepo, $this->courseRepo);
        $this->updateUC    = new UpdateStudentUseCase($this->studentRepo, $this->courseRepo);
        $this->deleteUC    = new DeleteStudentUseCase($this->studentRepo);
    }

    public function index(): void
    {
        $data = array_map(fn($s) => $s->toArray(), $this->studentRepo->findAll());
        JsonResponse::send($data);
    }

    public function show(string $id): void
    {
        $student = $this->studentRepo->findById($id);
        if (!$student) {
            JsonResponse::send(['error' => 'Student not found'], 404);
        }
        JsonResponse::send($student->toArray());
    }

    public function store(): void
    {
        try {
            $body = $this->getJsonBody();
            $this->createUC->execute(new CreateStudentCommand(
                $body['name'],
                $body['surname'],
                $body['dni'],
                $body['mail'],
                $body['courseId']
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