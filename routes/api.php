<?php

use Illuminate\Support\Facades\Route;


Route::prefix('telegram')->group(function () {
    Route::prefix('webhook')->group(function () {
        Route::post('/', [\Mong\TelegramChat\Controllers\TelegramWebhookController::class, 'handle']);
        Route::get('/register', [\Mong\TelegramChat\Controllers\TelegramWebhookController::class, 'register']);
        Route::get('/webhook-info', [\Mong\TelegramChat\Controllers\TelegramWebhookController::class, 'webhookInfo']);
    });
});
