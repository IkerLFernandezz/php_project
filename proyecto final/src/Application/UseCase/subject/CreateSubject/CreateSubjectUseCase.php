<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\CreateSubject;

use App\Domain\Subject\Subject;

use App\Domain\Subject\Columns\SubjectId;
use App\Domain\Subject\Columns\SubjectName;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;
use App\Infrastructure\Persistence\Doctrine\SubjectRepository;
use App\Infrastructure\Persistence\Doctrine\TeacherRepository;
use Exception;


final class CreateSubjectUseCase
{
    public function __construct(
        private SubjectRepository $subjectRepository,
        private CourseRepository $courseRepository,
        private TeacherRepository $teacherRepository
    ) {
    }

    public function execute(CreateSubjectCommand $command): void
    {
        $course = $this->courseRepository->findById($command->courseId);
        if (!$course) {
            throw new Exception("Course not found");
        }

        $teacher = $this->teacherRepository->findById($command->teacherId);
        if (!$teacher) {
            throw new Exception("Teacher not found");
        }

        $id = bin2hex(random_bytes(16));

        $subject = new Subject(
            new SubjectId($id),
            new SubjectName($command->name),
            $course,
            $teacher
        );

        $this->subjectRepository->save($subject);
    }
}