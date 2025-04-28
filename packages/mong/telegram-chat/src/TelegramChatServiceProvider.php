<?php

namespace Mong\TelegramChat;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Mong\TelegramChat\Commands\InsertWebhookRoute;

class TelegramChatServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->commands([
            InsertWebhookRoute::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // $this->loadRoutesFrom(__DIR__ . '/routes/backpack/custom.php');
        // $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        // $this->loadViewsFrom(__DIR__ . '/resources/views', 'backpack-test');

    }
}
