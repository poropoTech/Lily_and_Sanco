<?php

use App\Domains\Configuration\System\Http\Controllers\Backend\App\GeneralStatisticsController;

use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.statistics'.
Route::group([
    'prefix' => 'statistics',
    'as' => 'statistics.',
], function () {
    Route::group([
        'prefix' => 'general',
        'as' => 'general.',
        'middleware' => 'permission:admin.access.app-config.notifications',
    ], function () {
        Route::get('/', [GeneralStatisticsController::class, 'index'])->name('index');
    });
});
