<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Book\IBookRepository;
use App\Domain\Book\Book;
use App\Domain\Book\BookId;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineBookRepository implements IBookRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findById(BookId $id): ?Book
    {
        return $this->entityManager->find(Book::class, $id);
    }

    public function saveBook(Book $book): void
    {
        $this->entityManager->persist($book);
    }
}