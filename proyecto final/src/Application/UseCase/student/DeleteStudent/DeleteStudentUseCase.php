<?php
declare(strict_types=1);

namespace App\Application\UseCase\Student\DeleteStudent;

use App\Infrastructure\Persistence\Doctrine\StudentRepository;

final class DeleteStudentUseCase
{
    public function __construct(private StudentRepository $repository)
    {
    }

    public function execute(string $id): void
    {
        $student = $this->repository->findById($id);
        if ($student) {
            $this->repository->remove($student);
        }
    }
}