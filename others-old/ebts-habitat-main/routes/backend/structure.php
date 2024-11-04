<?php

use App\Domains\Structure\Http\Controllers\Backend\Activity\ActivityController;
use App\Domains\Structure\Http\Controllers\Backend\Category\CategoryController;
use App\Domains\Structure\Http\Controllers\Backend\FileUploadController;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Models\Category;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.structure'.
Route::group([
    'prefix' => 'structure',
    'as' => 'structure.',
    //'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {

    Route::group([
        'prefix' => 'category',
        'as' => 'category.',
        'middleware' => 'permission:admin.access.structure.category',
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Gestión de Categorías'), route('admin.structure.category.index'));
            });

        Route::get('create', [CategoryController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.structure.category.index')
                    ->push(__('Crear Categoría'), route('admin.structure.category.create'));
            });

        Route::post('/', [CategoryController::class, 'store'])->name('store');

        Route::group(['prefix' => '{category}'], function () {
            Route::get('edit', [CategoryController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Category $category) {
                    $trail->parent('admin.structure.category.index')
                        ->push(__('Editing :role', ['role' => $category->name]), route('admin.structure.category.edit', $category));
                });

            Route::patch('/', [CategoryController::class, 'update'])->name('update');
            Route::delete('/', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });

    Route::group([
        'prefix' => 'activity',
        'as' => 'activity.',
        'middleware' => 'permission:admin.access.structure.activity',
    ], function () {
        Route::get('/', [ActivityController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Gestión de Actividades'), route('admin.structure.activity.index'));
            });

        Route::get('create', [ActivityController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.structure.activity.index')
                    ->push(__('Crear Actividad'), route('admin.structure.activity.create'));
            });

        Route::post('/', [ActivityController::class, 'store'])->name('store');

        Route::group(['prefix' => '{activity}'], function () {
            Route::get('edit', [ActivityController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Activity $activity) {
                    $trail->parent('admin.structure.activity.index')
                        ->push(__('Editing :role', ['role' => $activity->name]), route('admin.structure.activity.edit', $activity));
                });

            Route::post('/', [ActivityController::class, 'copy'])->name('copy');
            Route::patch('/', [ActivityController::class, 'update'])->name('update');
            Route::delete('/', [ActivityController::class, 'destroy'])->name('destroy');
        });
    });
});
