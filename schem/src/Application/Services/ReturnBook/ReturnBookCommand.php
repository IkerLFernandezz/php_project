<?php

namespace App\Application\Services\ReturnBook;

use App\Domain\Book\BookId;

final class ReturnBookCommand
{
    public function __construct(
        public readonly BookId $bookId
    ) {
    }
}