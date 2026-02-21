<?php

namespace App\Domain\Book;

use Exception;

use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Book
{
    private BookID $id;
    private Title $title;
    private string $author = "Unknown";
    private bool $isBorrowed = false;

    public function __construct(BookId $id, Title $title)
    {
        $this->id = $id;
        $this->setTitle($title);
    }

    public function setTitle(Title $title): void
    {
        if (empty(trim($title))) {
            throw new Exception("title cannot be empty");
        }
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function borrow(): void
    {
        if ($this->isBorrowed) {
            throw new Exception("book is already borrowed");
        }
        $this->isBorrowed = true;
    }
    public function return(): void
    {
        $this->isBorrowed = false;
    }

}