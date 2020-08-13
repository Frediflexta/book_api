<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BooksInterface;
use App\Services\BooksServices;

class BooksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BooksInterface::class,
            BooksServices::class
        );
    }
}
