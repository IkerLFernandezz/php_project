<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use App\Application\UseCase\Department\CreateDepartment\CreateDepartmentCommand;
use App\Application\UseCase\Department\CreateDepartment\CreateDepartmentUseCase;
use App\Application\UseCase\Department\DeleteDepartment\DeleteDepartmentUseCase;
use App\Application\UseCase\Department\UpdateDepartment\UpdateDepartmentCommand;
use App\Application\UseCase\Department\UpdateDepartment\UpdateDepartmentUseCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\JsonResponse;
use App\Infrastructure\Persistence\Doctrine\DoctrineDepartmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

final class DepartmentApiController
{
    private DoctrineDepartmentRepository $repo;
    private CreateDepartmentUseCase $createUC;
    private UpdateDepartmentUseCase $updateUC;
    private DeleteDepartmentUseCase $deleteUC;

    public function __construct(Request $request, EntityManagerInterface $em)
    {
        $this->repo     = new DoctrineDepartmentRepository($em);
        $this->createUC = new CreateDepartmentUseCase($this->repo);
        $this->updateUC = new UpdateDepartmentUseCase($this->repo);
        $this->deleteUC = new DeleteDepartmentUseCase($this->repo);
    }

    public function index(): void
    {
        $data = array_map(fn($d) => [
            'id'   => $d->getId()->value(),
            'name' => $d->getName()->value(),
        ], $this->repo->findAll());
        JsonResponse::send($data);
    }

    public function show(string $id): void
    {
        $dep = $this->repo->findById($id);
        if (!$dep) { JsonResponse::send(['error' => 'Department not found'], 404); }
        JsonResponse::send([
            'id'   => $dep->getId()->value(),
            'name' => $dep->getName()->value(),
        ]);
    }

    public function store(): void
    {
        try {
            $body = json_decode(file_get_contents('php://input'), true) ?? [];
            $this->createUC->execute(new CreateDepartmentCommand($body['name']));
            JsonResponse::send(['status' => 'created'], 201);
        } catch (Throwable $e) {
            JsonResponse::send(['error' => $e->getMessage()], 400);
        }
    }

    public function update(string $id): void
    {
        try {
            $body = json_decode(file_get_contents('php://input'), true) ?? [];
            $this->updateUC->execute(new UpdateDepartmentCommand($id, $body['name']));
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