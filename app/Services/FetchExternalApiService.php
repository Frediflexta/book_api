<?php

namespace App\Services;

use App\Repositories\FetchExternalApiInterface;
use Illuminate\Support\Facades\Http;
use App\Models\Author;
use App\Models\Book;

class FetchExternalApiService implements FetchExternalApiInterface
{
  public function fetchIceAndFire()
  {
    $response = Http::get('https://www.anapioficeandfire.com/api/books');

        $responseData = $response->json();

        foreach($responseData as $data) {
          $author = $this->findOrCreateAuthor($data);

          $this->findOrCreateBooks($data, $author);
        }
  }

  public function findOrCreateAuthor(array $data)
  {
    return Author::firstOrCreate([
      'name' => $data['authors'][0]
    ]);
  }

  public function findOrCreateBooks(array $data, object $author)
  {
    return Book::firstOrCreate([
      'author_id' => $author->where('name', $data['authors'][0])->get()->pluck('id')[0],
      'name' =>  $data['name'],
      'isbn' =>  $data['isbn'],
      'number_of_pages' => $data['numberOfPages'],
      'publisher' => $data['publisher'],
      'country' => $data['country'],
      'release_date' => $data['released']
    ]);
  }
}