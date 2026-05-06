<?php
declare(strict_types=1);

namespace App\Application\UseCase\Subject\CreateSubject;

use App\Domain\Course\CourseRepositoryInterface;
use App\Domain\Subject\Subject;

use App\Domain\Subject\Columns\SubjectId;
use App\Domain\Subject\Columns\SubjectName;
use App\Domain\Subject\SubjectRepositoryInterface;
use App\Domain\Teacher\TeacherRepositoryInterface;
use Exception;


final class CreateSubjectUseCase
{
    public function __construct(
        private SubjectRepositoryInterface $subjectRepository,
        private CourseRepositoryInterface $courseRepository,
        private TeacherRepositoryInterface $teacherRepository
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