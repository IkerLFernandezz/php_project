<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Student\Student;
use App\Infrastructure\Persistence\Doctrine\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineStudentRepository implements StudentRepository
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function save(Student $student): void
    {
        $this->em->persist($student);
        $this->em->flush();
    }

    public function findById(string $id): ?Student
    {
        return $this->em->find(Student::class, $id);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Student::class)->findAll();
    }

    public function remove(Student $student): void
    {
        $this->em->remove($student);
        $this->em->flush();
    }
}