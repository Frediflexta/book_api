<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Author::all()->each(function($author) {
           $author->books()->saveMany(factory(Book::class, 10)->make());
       });
    }
}
