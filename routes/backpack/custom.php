<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('product', 'ProductCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('brand', 'BrandCrudController');
    Route::crud('product-image', 'ProductImageCrudController');
    Route::get('telegram_chat', 'TelegramChatController@index')->name('page.telegram_chat.index');
    Route::get('telegram_announcement', 'TelegramAnnouncementController@index')->name('page.telegram_announcement.index');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
