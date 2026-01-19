<?php

namespace App\Application\Services\BorrowBook;

use App\Domain\Book\IBookRepository;
use App\Domain\Book\BookId;
use Exception;

final class BorrowBookHandler
{
    public function __construct(private IBookRepository $repository)
    {
    }

    public function handle(BorrowBookCommand $command): void
    {
        $book = $this->repository->findById(new BookId($command->bookId));

        if ($book === null) {
            throw new Exception('Book not found');
        }

        $book->borrow();
        $this->repository->saveBook($book);
    }
}