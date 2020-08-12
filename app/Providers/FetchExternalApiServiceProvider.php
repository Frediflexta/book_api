<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\FetchExternalApiInterface;
use App\Services\FetchExternalApiService;

class FetchExternalApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            FetchExternalApiInterface::class,
            FetchExternalApiService::class
        );
    }
}
