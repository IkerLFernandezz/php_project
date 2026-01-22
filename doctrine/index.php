<?php

require_once "bootstrap.php";
use Domain\Book;

$em = $entityManager;
$book = new Book("1984", "George Orwell", "Facundo");