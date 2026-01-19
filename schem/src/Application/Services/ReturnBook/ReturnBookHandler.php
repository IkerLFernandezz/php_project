<?php

namespace App\Application\Services\ReturnBook;

use App\Domain\Book\IBookRepository;
use Exception;

final class ReturnBookHandler
{
    public function __construct(
        private readonly IBookRepository $bookRepository
    ) {
    }

    public function handle(ReturnBookCommand $command): void
    {
        $book = $this->bookRepository->findById($command->bookId);

        if ($book === null) {
            throw new Exception('Book not found');
        }

        $book->return();
        
        $this->bookRepository->saveBook($book);
    }
}