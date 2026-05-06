<?php
declare(strict_types=1);

namespace App\Domain\Subject;

use App\Domain\Subject\Subject;

interface SubjectRepositoryInterface
{
    public function save(Subject $subject): void;

    public function findById(string $id): ?Subject;

    public function findAll(): array;

    public function remove(Subject $subject): void;
}