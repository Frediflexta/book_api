<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use App\Models\Author;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author_id' => factory(Author::class)->make()->id,
        'name' => $faker->sentence,
        'isbn' => $faker->isbn13,
        'number_of_pages' => $faker->numberBetween(300, 1000),
        'publisher' => $faker->company,
        'country' => $faker->country,
        'release_date' => $faker->date,
    ];
});
