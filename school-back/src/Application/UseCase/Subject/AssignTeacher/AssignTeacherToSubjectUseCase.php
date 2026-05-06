<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\AssignTeacher;

use App\Domain\Subject\SubjectRepositoryInterface;
use App\Domain\Teacher\TeacherRepositoryInterface;
use Exception;

final class AssignTeacherToSubjectUseCase
{
    public function __construct(
        private SubjectRepositoryInterface $subjectRepository,
        private TeacherRepositoryInterface $teacherRepository
    ) {
    }

    public function execute(AssignTeacherToSubjectCommand $command): void
    {
        $subject = $this->subjectRepository->findById($command->subjectId);
        $teacher = $this->teacherRepository->findById($command->teacherId);

        if (!$subject) {
            throw new Exception("Subject not found");
        }

        if (!$teacher) {
            throw new Exception("Teacher not found");
        }

        // 💡 lógica de dominio
        $subject->assignTeacher($teacher);

        $this->subjectRepository->save($subject);
    }
}