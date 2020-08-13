<?php

namespace App\Services;

use App\Repositories\BooksInterface;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BooksServices implements BooksInterface
{
  public function displayAllBooks()
  {
    return Book::with('author')->get();
  }

  public function createBooks($request)
  {
    $validatedFields = $request->validated();

    DB::beginTransaction();

    $author = Author::firstOrCreate([
        'name' => $request->author
    ]);

    $book = Book::create([
        'author_id' => $author->id,
        'name' => $validatedFields['name'],
        'isbn' => $validatedFields['isbn'],
        'number_of_pages' => $validatedFields['number_of_pages'],
        'publisher' => $validatedFields['publisher'],
        'country' => $validatedFields['country'],
        'release_date' => $validatedFields['release_date']
    ]);
    DB::commit();

    return $book->where('author_id', $author->id)->with('author')->get();
  }

  public function getOneBook($book)
  {
    return $book->load('author');
  }

  public function updateABook($request, $book)
  {
    DB::transaction(function() use($request, $book) {
      if ($request->has('author')) {
          $book->author->update([
              'name' => $request->author
          ]);
      }
      $book->fill(Arr::except($request->validated(), ['author']));

      $book->save();
    });

    return $book;
  }

  public function destroyABook($book)
  {
    return $book->delete() ? [] : false;
  }

  public function getQueryParamBook($request)
  {
    if($request->has('name')) {
      return Book::where('name', $request->query('name'))->with('author')->get();
    }
  }
}

