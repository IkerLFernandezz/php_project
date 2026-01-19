<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Persistence\InMemory\InMemoryBookRepository;
use App\Application\Services\BorrowBook\BorrowBookCommand;
use App\Application\Services\BorrowBook\BorrowBookHandler;
use App\Domain\Book\Book;
use App\Domain\Book\BookId;
use App\Domain\Book\Title;

$repository = new InMemoryBookRepository();

$book = new Book(
    new BookId('b1'),
    new Title('DDD in PHP')
);

$repository->saveBook($book);

$handler = new BorrowBookHandler($repository);

try {
    $handler->handle(new BorrowBookCommand('b1'));
    echo "Book borrowed successfully" . PHP_EOL;

    $handler->handle(new BorrowBookCommand('b1'));
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}