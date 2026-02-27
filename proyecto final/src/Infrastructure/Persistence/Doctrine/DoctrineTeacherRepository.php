<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Teacher\Teacher;
use App\Infrastructure\Persistence\Doctrine\TeacherRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineTeacherRepository implements TeacherRepository
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function save(Teacher $teacher): void
    {
        $this->em->persist($teacher);
        $this->em->flush();
    }

    public function findById(string $id): ?Teacher
    {
        return $this->em->find(Teacher::class, $id);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Teacher::class)->findAll();
    }

    public function remove(Teacher $teacher): void
    {
        $this->em->remove($teacher);
        $this->em->flush();
    }
}