<?php

namespace App\Domain\Book;

class Title
{
    private string $title;
    function __construct(string $title)
    {
        $this->title = $title;
    }

    function value(): string
    {
        return $this->title;
    }

    function __toString(): string
    {
        return $this->title;
    }
}