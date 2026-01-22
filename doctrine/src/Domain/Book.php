<?php

namespace Domain;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('books')]
final class Book
{
    #[Id, Column(type: Types::STRING)]
    private string $id;

    #[Column(type: Types::STRING)]
    private string $title;

    #[Column(type: Types::STRING)]
    private string $author;

    public function __construct(string $id, string $title, string $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
    }
}