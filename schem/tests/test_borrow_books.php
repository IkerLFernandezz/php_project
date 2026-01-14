<?php

require __DIR__ . '../../vendor/autoload.php';

use App\Domain\Book\Book;
use App\Domain\Book\Title;
use App\Domain\Book\BookId;

$book1 = new Book(
    new BookId('1'),
    new Title('The Great Gatsby')
);

$book2 = new Book(
    new BookId('2'),
    new Title('1984')
);


// case borrow book
try {
    $book1->borrow();
    echo "Book: {$book1->getTitle()} borrowed successfully." . PHP_EOL;

    $book2->borrow();
    echo "Book: {$book2->getTitle()} borrowed successfully." . PHP_EOL;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

// cape return book
try {
    $book1->return();
    echo "Book {$book1->getTitle()} returned successfully." . PHP_EOL;

    $book2->return();
    echo "Book {$book2->getTitle()} returned successfully." . PHP_EOL;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}