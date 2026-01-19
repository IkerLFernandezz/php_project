<?php
declare(strict_types=1);
namespace Domain;

final class Book
{
    private string $id, $title, $author;

    public function __construct(string $id, string $title, string $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
    }

}