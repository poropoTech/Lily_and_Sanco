<?php

use App\Domains\Configuration\System\Http\Controllers\Backend\App\NotificationsConfigController;
use App\Domains\Configuration\System\Http\Controllers\Backend\App\RunningConfigController;

use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.config.app'.
Route::group([
    'prefix' => 'config',
    'as' => 'config.',
    //'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group(['prefix' => 'app', 'as' => 'app.',
    ], function () {
        Route::group([
            'prefix' => 'notifications',
            'as' => 'notifications.',
            'middleware' => 'permission:admin.access.app-config.notifications',
        ], function () {
            Route::get('/', [NotificationsConfigController::class, 'index'])->name('index');
            Route::patch('/', [NotificationsConfigController::class, 'update'])->name('update');
        });
        Route::group([
            'prefix' => 'running',
            'as' => 'running.',
            'middleware' => 'permission:admin.access.app-config.running',
        ], function () {
            Route::get('/', [RunningConfigController::class, 'index'])->name('index');
            Route::patch('/', [RunningConfigController::class, 'update'])->name('update');
        });
    });
});
