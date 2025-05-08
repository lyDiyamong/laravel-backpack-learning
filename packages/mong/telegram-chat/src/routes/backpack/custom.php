<?php

use Illuminate\Support\Facades\Route;
Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'Mong\TelegramChat\Controllers\Admin',
], function () { // custom admin routes
    Route::get('telegram_chat', 'TelegramChatController@index')->name('page.telegram_chat.index');
    Route::get('telegram_announcement', 'TelegramAnnouncementController@index')->name('page.telegram_announcement.index');
}); // this should be the absolute last line of this file