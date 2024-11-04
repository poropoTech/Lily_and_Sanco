<?php

use App\Http\Controllers\LocaleController;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

//Route::get('/notification', function () {
//    $comment = \App\Domains\Structure\Models\Activity::find(1);
//    $user = \App\Domains\Auth\Models\User::find(1);
//
//    return (new \App\Domains\Structure\Notifications\Frontend\ActivityPublishedNotification($comment))
//        ->toMail($user);
//});
