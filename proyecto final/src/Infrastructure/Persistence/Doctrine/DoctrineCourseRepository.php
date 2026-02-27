<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Course\Course;
use App\Infrastructure\Persistence\Doctrine\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineCourseRepository implements CourseRepository
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function save(Course $course): void
    {
        $this->em->persist($course);
        $this->em->flush();
    }

    public function findById(string $id): ?Course
    {
        return $this->em->find(Course::class, $id);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Course::class)->findAll();
    }

    public function remove(Course $course): void
    {
        $this->em->remove($course);
        $this->em->flush();
    }
}