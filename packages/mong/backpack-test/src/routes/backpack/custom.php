<?php

use Illuminate\Support\Facades\Route;
use Mong\BackpackTest\Controllers\Admin\ProfileController;
use Mong\BackpackTest\Controllers\Admin\CatalogCrudController;

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
    // 'namespace' => 'Mong\BackpackTest\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('catalog', CatalogCrudController::class);
    Route::get('profile', [ProfileController::class, 'index'])->name('page.profile.index');
}); // this should be the absolute last line of this file

// //  Livewire Pages
// Route::group([
//     'namespace' => 'Mong\BackpackTest\Livewire',
//     'prefix' => 'admin',
//     'middleware' => array_merge(
//         (array) config('backpack.base.web_middleware', 'web'),
//         (array) config('backpack.base.middleware_key', 'admin')
//     )
// ], function () {
//     Route::get("profile", Profile::class)->name("profile");
// });

/**
 * DO NOT ADD ANYTHING HERE.
 */
