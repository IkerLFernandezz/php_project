<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Subject\Subject;
use App\Infrastructure\Persistence\Doctrine\SubjectRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineSubjectRepository implements SubjectRepository
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function save(Subject $subject): void
    {
        $this->em->persist($subject);
        $this->em->flush();
    }

    public function findById(string $id): ?Subject
    {
        return $this->em->find(Subject::class, $id);
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Subject::class)->findAll();
    }

    public function remove(Subject $subject): void
    {
        $this->em->remove($subject);
        $this->em->flush();
    }
}