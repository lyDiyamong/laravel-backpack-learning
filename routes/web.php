<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Telegram\TelegramWebhookController;

Route::get('/', function () {
    return view('welcome');
});