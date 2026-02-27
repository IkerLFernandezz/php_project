<?php
declare(strict_types=1);

namespace App\Application\UseCase\Teacher\DeleteTeacher;

use App\Infrastructure\Persistence\Doctrine\TeacherRepository;
use Exception;

final class DeleteTeacherUseCase
{
    public function __construct(
        private TeacherRepository $teacherRepository
    ) {
    }

    public function execute(string $id): void
    {
        $teacher = $this->teacherRepository->findById($id);

        if (!$teacher) {
            throw new Exception("Teacher not found");
        }

        $this->teacherRepository->remove($teacher);
    }
}