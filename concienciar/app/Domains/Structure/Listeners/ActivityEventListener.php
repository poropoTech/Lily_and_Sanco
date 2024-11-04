<?php

namespace App\Domains\Structure\Listeners;

use App\Domains\Notifications\Services\NotificationService;
use App\Domains\Structure\Events\Activity\ActivityCreated;
use App\Domains\Structure\Events\Activity\ActivityDeleted;
use App\Domains\Structure\Events\Activity\ActivityPublished;
use App\Domains\Structure\Events\Activity\ActivityUpdated;

/**
 * Class ActivityEventListener.
 */
class ActivityEventListener
{

    protected NotificationService $notificationService;

    /**
     * ActivityEventListener constructor.
     * @param $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('activity')
            ->performedOn($event->activity)
            ->withProperties(['name' => $event->activity->title])
            ->log(':causer.name creó la actividad :subject.name');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        activity('activity')
            ->performedOn($event->activity)
            ->withProperties(['name' => $event->activity->title])
            ->log(':causer.name modificó la actividad :subject.name');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        activity('activity')
            ->performedOn($event->activity)
            ->withProperties(['name' => $event->activity->title])
            ->log(':causer.name eliminó la actividad :subject.name');
    }

    /**
     * @param $event
     */
    public function onPublished($event)
    {
        activity('activity')
            ->performedOn($event->activity)
            ->withProperties(['name' => $event->activity->title])
            ->log(':causer.name publicó la actividad :subject.name');

        $this->notificationService->activityPublished($event->activity);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ActivityCreated::class,
            'App\Domains\Structure\Listeners\ActivityEventListener@onCreated'
        );

        $events->listen(
            ActivityUpdated::class,
            'App\Domains\Structure\Listeners\ActivityEventListener@onUpdated'
        );

        $events->listen(
            ActivityDeleted::class,
            'App\Domains\Structure\Listeners\ActivityEventListener@onDeleted'
        );

        $events->listen(
            ActivityPublished::class,
            'App\Domains\Structure\Listeners\ActivityEventListener@onPublished'
        );
    }
}
