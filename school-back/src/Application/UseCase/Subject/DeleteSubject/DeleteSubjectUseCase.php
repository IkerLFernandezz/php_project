<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\DeleteSubject;

use App\Domain\Subject\SubjectRepositoryInterface;
use Exception;

final class DeleteSubjectUseCase
{
    public function __construct(
        private SubjectRepositoryInterface $subjectRepository
    ) {
    }

    public function execute(string $subjectId): void
    {
        $subject = $this->subjectRepository->findById($subjectId);

        if (!$subject) {
            throw new Exception("Subject not found");
        }

        $this->subjectRepository->remove($subject);
    }
}