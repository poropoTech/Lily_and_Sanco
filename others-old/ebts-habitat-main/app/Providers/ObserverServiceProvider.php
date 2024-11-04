<?php

namespace App\Providers;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Observers\UserObserver;
use App\Domains\Auth\Models\Department;
use App\Domains\Auth\Observers\DepartmentObserver;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Observers\ActivityObserver;
use App\Domains\Structure\Observers\CategoryObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Class ObserverServiceProvider.
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Activity::observe(ActivityObserver::class);
        Department::observe(DepartmentObserver::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
