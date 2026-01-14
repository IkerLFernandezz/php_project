<?php
require 'src/Book.php';
require 'src/Library.php';
use App\Book;
use App\Library;

$book = new Book("jajaja tu puta madre", "me cafo e3n todo");
$book2 = new Book("jajaja tu puta madre2", "me cafo e3n todo2");


$library = new Library();

$library->addBook($book);
$library->addBook($book2);

$library->showCatalog();
