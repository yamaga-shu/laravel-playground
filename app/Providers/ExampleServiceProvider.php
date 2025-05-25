<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GreetService;

class ExampleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('greet', fn () => new GreetService());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
