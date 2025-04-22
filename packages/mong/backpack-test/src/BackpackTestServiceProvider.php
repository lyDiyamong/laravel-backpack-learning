<?php

namespace Mong\BackpackTest;

use Illuminate\Support\ServiceProvider;

class BackpackTestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->loadRoutesFrom(__DIR__ . '/routes/backpack/custom.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        
    }
}
