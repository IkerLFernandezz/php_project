<?php

namespace App;

class Library {
    protected array $books = [];

    public function addBook(Book $book) {
        $this->books[] = $book;
        return $this;
    }

    public function getBooks(): array {
        return $this->books;
    }

    public function showCatalog(): void {
        $i = 1;
        foreach ($this->books as $book) {
            echo "$i. Title: " . $book->getTitle() . ", Author: " . $book->getAuthor() . "<br>";
            $i++;
        }
    }
}
