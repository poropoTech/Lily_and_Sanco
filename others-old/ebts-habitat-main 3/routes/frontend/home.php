<?php

use App\Domains\Structure\Http\Controllers\Frontend\Activity\ActivityController;
use App\Domains\Structure\Http\Controllers\Frontend\Category\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\KnowMoreController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\WallController;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Models\Activity;

use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::group(['middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push('Home', route('frontend.index'));
        });

    Route::get('c', [CategoryController::class, 'index'])
        ->name('pages.categories')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Desafíos'), route('frontend.pages.categories'));
        });

    Route::get('c/{category}', [CategoryController::class, 'category'])
        ->name('pages.category')
        ->breadcrumbs(function (Trail $trail, Category $category) {
            $trail->parent('frontend.pages.categories')
                ->push(__($category->name), route('frontend.pages.category', ['category' => $category->id]));
        });

    Route::get('a/{activity}', [ActivityController::class, 'index'])
        ->name('pages.activity')
        ->breadcrumbs(function (Trail $trail, Activity $activity) {
            $trail->parent('frontend.pages.category', $activity->category)
                ->push(__($activity->title), route('frontend.pages.activity', ['activity' => $activity->id]));
        });

    Route::get('saber-mas', [KnowMoreController::class, 'index'])
        ->name('pages.knowmore')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Saber más'), route('frontend.pages.knowmore'));
        });

    Route::get('muro', [WallController::class, 'index'])
        ->name('pages.wall')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Muro'), route('frontend.pages.wall'));
        });

    Route::get('terms', [TermsController::class, 'index'])
        ->name('pages.terms')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
        });
});
