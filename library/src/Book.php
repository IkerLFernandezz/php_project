<?php

namespace App;

final class Book{
    protected string $title, $author;

    public function __construct(string $title, string $author){
        $this->title = $title;
        $this->author = $author;
    }

    public function setAuthor(string $author) {
        $this->author = $author;
        return $this;
    }

    public function setTitle(string $title) {
        $this->title = $title;
        return $this;
    }
    public function getAuthor(): string {
        return $this->author;
    }
    public function getTitle(): string {
        return $this->title;
    }
}