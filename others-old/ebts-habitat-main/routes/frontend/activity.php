<?php

use App\Domains\Structure\Http\Controllers\Frontend\Activity\ActivityController;
use App\Domains\Structure\Http\Controllers\Frontend\Activity\ActivityFeedController;


/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::group(['as' => 'activities.', 'prefix' => 'a',], function () {
    Route::group(['middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {

        Route::get('{activity}/new_response/{challenge}', [ActivityController::class, 'new_response'])
            ->name('new_response');

        Route::get('feed/category/{category}', [ActivityFeedController::class, 'category_wall_feed'])
            ->name('category_wall_feed');

        Route::get('feed/categories', [ActivityFeedController::class, 'categories_wall_feed'])
            ->name('categories_wall_feed');

        Route::get('feed/user/incomplete', [ActivityFeedController::class, 'user_incomplete_wall_feed'])
            ->name('user_incomplete_wall_feed');

    });

});
