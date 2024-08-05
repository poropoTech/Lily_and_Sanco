<?php

namespace App\Domains\Structure\Listeners;

use App\Domains\Structure\Events\Category\CategoryCreated;
use App\Domains\Structure\Events\Category\CategoryDeleted;
use App\Domains\Structure\Events\Category\CategoryUpdated;

/**
 * Class CategoryEventListener.
 */
class CategoryEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('category')
            ->performedOn($event->category)
            ->withProperties(['name' => $event->category->name])
            ->log(':causer.name creó la categoría :subject.name');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        activity('category')
            ->performedOn($event->category)
            ->withProperties(['name' => $event->category->name])
            ->log(':causer.name modificó la categoría :subject.name');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        activity('category')
            ->performedOn($event->category)
            ->log(':causer.name eliminó la categoría :subject.name');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            CategoryCreated::class,
            'App\Domains\Structure\Listeners\CategoryEventListener@onCreated'
        );

        $events->listen(
            CategoryUpdated::class,
            'App\Domains\Structure\Listeners\CategoryEventListener@onUpdated'
        );

        $events->listen(
            CategoryDeleted::class,
            'App\Domains\Structure\Listeners\CategoryEventListener@onDeleted'
        );
    }
}
