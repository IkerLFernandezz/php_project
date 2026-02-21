<?php

namespace App\Domain\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookId;

interface IBookRepository
{
    public function saveBook(Book $book): void;

    public function findById(BookId $id): ?Book;
}