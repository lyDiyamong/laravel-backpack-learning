<?php

namespace Mong\BackpackTest;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Mong\BackpackTest\Livewire\Profile;

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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'backpack-test');

        // Register Livewire components
        Livewire::component('backpack-test.profile', Profile::class);
    }
}
