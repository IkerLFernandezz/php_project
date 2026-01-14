<?php

namespace App\Domain\Book;

class BookId{
    private string $id;
    function __construct(string $id)
    {
        $this->id = $id;
    }

    function value(): string{
        return $this->id;
    }

    function __toString(): string
    {
        return $this->id;
    }

    
}