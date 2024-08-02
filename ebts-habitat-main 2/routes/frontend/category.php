<?php

use App\Domains\Structure\Http\Controllers\Frontend\Category\CategoryController;


/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::group(['as' => 'categories.', 'prefix' => 'a',], function () {
    Route::group(['middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {

        Route::get('{category}/activity_feed', [CategoryController::class, 'activity_feed'])
            ->name('activity_feed');

    });

});
