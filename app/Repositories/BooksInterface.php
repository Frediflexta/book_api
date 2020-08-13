<?php

namespace App\Repositories;

use App\Models\Book;

interface BooksInterface
{
  public function displayAllBooks();

  public function createBooks($request);

  public function getOneBook($book);

  public function updateABook($request, $book);

  public function destroyABook($book);

  public function getQueryParamBook($request);
}