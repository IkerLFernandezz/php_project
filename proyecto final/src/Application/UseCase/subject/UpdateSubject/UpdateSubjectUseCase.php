<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\UpdateSubject;

use App\Domain\Subject\Columns\SubjectName;
use App\Infrastructure\Persistence\Doctrine\SubjectRepository;
use App\Infrastructure\Persistence\Doctrine\TeacherRepository;
use Exception;

final class UpdateSubjectUseCase
{
    public function __construct(
        private SubjectRepository $subjectRepository,
        private TeacherRepository $teacherRepository
    ) {
    }

    public function execute(UpdateSubjectCommand $command): void
    {
        $subject = $this->subjectRepository->findById($command->subjectId);
        if (!$subject) {
            throw new Exception("Subject not found");
        }

        $teacher = $this->teacherRepository->findById($command->teacherId);
        if (!$teacher) {
            throw new Exception("Teacher not found");
        }

        $subject->setName(new SubjectName($command->name));
        $subject->assignTeacher($teacher);

        $this->subjectRepository->save($subject);
    }
}