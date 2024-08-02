<?php

use App\Domains\Responses\Http\Controllers\Frontend\ResponseController;
use App\Domains\Responses\Http\Controllers\Frontend\ResponseFeedController;
use App\Domains\Responses\Http\Controllers\Frontend\ResponseCommentController;


/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::group(['as' => 'responses.', 'prefix' => 'r',], function () {
    Route::group(['middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
        Route::post('/', [ResponseController::class, 'store'])->name('store');

        Route::post('{response}/delete', [ResponseController::class, 'delete'])
            ->name('delete');

        Route::post('{response}/publish', [ResponseController::class, 'publish'])
            ->name('publish');

        Route::post('{response}/like', [ResponseController::class, 'like'])
            ->name('like');

        Route::post('{response}/comment', [ResponseCommentController::class, 'store'])
            ->name('comment');

        Route::post('comments/{comment}/delete', [ResponseCommentController::class, 'delete'])
            ->name('comment.delete');

        Route::post('comments/{comment}/publish', [ResponseCommentController::class, 'publish'])
            ->name('comment.publish');

        Route::get('{response}/comment/feed', [ResponseCommentController::class, 'feed'])
            ->name('comment_feed');

        Route::get('feed/wall', [ResponseFeedController::class, 'global_wall_feed'])
            ->name('wall_response_feed');

        Route::get('feed/activity/{activity}', [ResponseFeedController::class, 'activity_wall_feed'])
            ->name('activity_wall_feed');
    });

});
