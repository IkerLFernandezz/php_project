<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Department\Department;
use App\Domain\Department\DepartmentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineDepartmentRepository implements DepartmentRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function save(Department $department): void
    {
        $this->em->persist($department);
        $this->em->flush();
    }

    public function findById(string $id): ?Department
    {
        return $this->em->find(Department::class, $id);
    }

    public function findAll(): array
    {
        return $this->em
            ->getRepository(Department::class)
            ->findAll();
    }

    public function remove(Department $department): void
    {
        $this->em->remove($department);
        $this->em->flush();
    }
}