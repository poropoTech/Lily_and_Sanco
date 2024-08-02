<?php

namespace App\Providers;

use App\Domains\Auth\Listeners\DepartmentEventListener;
use App\Domains\Auth\Listeners\RoleEventListener;
use App\Domains\Auth\Listeners\UserEventListener;
use App\Domains\Common\Listeners\CommentEventListener;
use App\Domains\Responses\Listeners\ResponseEventListener;
use App\Domains\Structure\Listeners\ActivityEventListener;
use App\Domains\Structure\Listeners\CategoryEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        RoleEventListener::class,
        UserEventListener::class,
        CategoryEventListener::class,
        ActivityEventListener::class,
        ResponseEventListener::class,
        DepartmentEventListener::class,
        CommentEventListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
