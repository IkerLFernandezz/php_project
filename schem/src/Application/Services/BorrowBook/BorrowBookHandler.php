<?php

namespace App\Application\Services\BorrowBook;

use App\Domain\Book\iBookRepository;

final class BorrowBookHandler
{
    public function __construct(private iBookRepository $repository)
    {
    }

    public function handle(BorrowBookCommand $command): void
    {
    }
}