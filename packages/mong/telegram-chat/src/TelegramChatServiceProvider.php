<?php

namespace Mong\TelegramChat;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Mong\TelegramChat\Services\S3FileService;
use Mong\TelegramChat\Services\TelegramService;
use Mong\TelegramChat\Commands\InsertWebhookRoute;
use Mong\TelegramChat\Contracts\FileServiceInterface;
use Mong\TelegramChat\Contracts\TelegramServiceInterface;

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
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        // $this->loadViewsFrom(__DIR__ . '/resources/views', 'backpack-test');

        $this->app->bind(FileServiceInterface::class, S3FileService::class);
        // $this->app->bind(TelegramServiceInterface::class, TelegramService::class);

    }
}