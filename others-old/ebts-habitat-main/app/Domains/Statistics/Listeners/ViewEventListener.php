<?php

namespace App\Domains\Statistics\Listeners;

use App\Domains\Statistics\Events\ViewCreated;

/**
 * Class ViewEventListener.
 */
class ViewEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('view')
            ->performedOn($event->view)
            ->withProperties(['name' => $event->view->activity->title])
            ->log(':causer.name visualizó :subject.name');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ViewCreated::class,
            'App\Domains\Responses\Listeners\ViewEventListener@onCreated'
        );

    }
}
