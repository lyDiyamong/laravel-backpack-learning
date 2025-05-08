<?php

namespace Mong\TelegramChat;


use Mong\TelegramChat\Livewire\ChatConversation;
use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Mong\TelegramChat\Services\S3FileService;
use Mong\TelegramChat\Services\TelegramService;
use Mong\TelegramChat\Commands\InsertWebhookRoute;
use Mong\TelegramChat\Commands\AddPusherToJS;
use Mong\TelegramChat\Contracts\FileServiceInterface;
use Mong\TelegramChat\Contracts\TelegramServiceInterface;
use Mong\TelegramChat\Livewire\TelegramUserList;

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
            AddPusherToJS::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/backpack/custom.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'telegram-chat');
        Livewire::component("telegram-chat.telegram-user-list", TelegramUserList::class);
        Livewire::component("telegram-chat.webhook", ChatConversation::class);

        $this->app->bind(FileServiceInterface::class, S3FileService::class);
        // $this->app->bind(TelegramServiceInterface::class, TelegramService::class);

    }
}
