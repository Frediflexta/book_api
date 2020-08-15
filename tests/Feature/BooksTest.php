<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBookTest extends TestCase
{
    use RefreshDatabase;

    public function getResponse($method, $url, $data = [])
    {
        return $this->json($method, $url, $data);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateBook()
    {
        $newBook = [
            'name'=> 'Beautiful Wings',
            'author'=> 'Itun Taiwo',
            'isbn'=> '9765837272989',
            'number_of_pages'=> 600,
            'publisher'=> 'illuminate Books',
            'country'=> 'Canada',
            'release_date'=> '2020-05-12'
        ];

        $this->getResponse('POST', '/api/v1/books', $newBook)->assertCreated();
    }

    public function testCreatingBookWithMissingFields()
    {
        $newBook = [
            'name'=> '',
            'author'=> 'Itun Taiwo',
            'isbn'=> '9765837272989',
            'number_of_pages'=> '',
            'publisher'=> 'illuminate Books',
            'country'=> 'Canada',
            'release_date'=> '2020-05-12'
        ];

        $this->getResponse('POST', '/api/v1/books', $newBook)->assertStatus(422);
    }

    public function testDisplayAllBooks()
    {
        $this->getResponse('GET', '/api/v1/books')->assertOk();
    }

    public function testDisplaySpecificBook()
    {
        $book = factory(Book::class)->create(['author_id' => factory(Author::class)]);

        $this->getResponse('GET', "/api/v1/books/{$book->id}")->assertOk();
    }

    /**
     * @test
     */
    public function testUpdateBook()
    {
        $book = factory(Book::class)->create([
            'author_id' => factory(Author::class),
        ]);
        
        $bookId = $book->id;
        
        $book = [
            'name' => 'Test updated name',
            'author' => 'TestUser'
        ];

        $this->getResponse('PUT', "/api/v1/books/{$bookId}", $book)->assertOk();
    }

    public function testDeleteABook()
    {
        $book = factory(Book::class)->create([
            'author_id' => factory(Author::class),
        ]);
        $this->getResponse('DELETE', "/api/v1/books/{$book->id}")->assertOk();
    }

    public function testQueryParamsBook()
    {
        $book = factory(Book::class)->create([
            'author_id' => factory(Author::class)->create()
        ]);

        $this->getResponse('GET', "/api/external-books?name={$book->name}")->assertOk();
    }
}
