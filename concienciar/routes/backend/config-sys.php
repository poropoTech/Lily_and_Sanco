<?php

use App\Domains\Configuration\System\Http\Controllers\Backend\System\StylesConfigController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.config.app'.
Route::group([
    'prefix' => 'config',
    'as' => 'config.',
    //'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group(['prefix' => 'sys', 'as' => 'sys.',
    ], function () {
        Route::group([
            'prefix' => 'styles',
            'as' => 'styles.',
            'middleware' => 'role:'.config('boilerplate.access.role.admin'),
        ], function () {
            Route::get('/', [StylesConfigController::class, 'index'])->name('index');
            Route::patch('/', [StylesConfigController::class, 'update'])->name('update');
        });
    });
});
