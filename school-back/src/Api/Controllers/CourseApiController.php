<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use App\Application\UseCase\Course\CreateCourse\CreateCourseCommand;
use App\Application\UseCase\Course\CreateCourse\CreateCourseUseCase;
use App\Application\UseCase\Course\DeleteCourse\DeleteCourseUseCase;
use App\Application\UseCase\Course\UpdateCourse\UpdateCourseCommand;
use App\Application\UseCase\Course\UpdateCourse\UpdateCourseUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\JsonResponse;
use App\Infrastructure\Persistence\Doctrine\DoctrineCourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

final class CourseApiController
{
    private DoctrineCourseRepository $repo;
    private CreateCourseUseCase $createUC;
    private UpdateCourseUseCase $updateUC;
    private DeleteCourseUseCase $deleteUC;

    public function __construct(Request $request, EntityManagerInterface $em)
    {
        $this->repo     = new DoctrineCourseRepository($em);
        $this->createUC = new CreateCourseUseCase($this->repo);
        $this->updateUC = new UpdateCourseUseCase($this->repo);
        $this->deleteUC = new DeleteCourseUseCase($this->repo);
    }

    public function index(): void
    {
        $data = array_map(fn($c) => [
            'id'       => $c->getId()->value(),
            'name'     => $c->getName()->value(),
            'schedule' => $c->getSchedule()->value(),
        ], $this->repo->findAll());
        JsonResponse::send($data);
    }

    public function show(string $id): void
    {
        $course = $this->repo->findById($id);
        if (!$course) { JsonResponse::send(['error' => 'Course not found'], 404); }
        JsonResponse::send([
            'id'       => $course->getId()->value(),
            'name'     => $course->getName()->value(),
            'schedule' => $course->getSchedule()->value(),
        ]);
    }

    public function store(): void
    {
        try {
            $body = json_decode(file_get_contents('php://input'), true) ?? [];
            $this->createUC->execute(new CreateCourseCommand($body['name'], $body['schedule']));
            JsonResponse::send(['status' => 'created'], 201);
        } catch (Throwable $e) {
            JsonResponse::send(['error' => $e->getMessage()], 400);
        }
    }

    public function update(string $id): void
    {
        try {
            $body = json_decode(file_get_contents('php://input'), true) ?? [];
            $this->updateUC->execute(new UpdateCourseCommand($id, $body['name'], $body['schedule']));
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
}