<?php

namespace App\Domains\Auth\Listeners;

use App\Domains\Auth\Events\Department\DepartmentCreated;
use App\Domains\Auth\Events\Department\DepartmentDeleted;
use App\Domains\Auth\Events\Department\DepartmentUpdated;

/**
 * Class DepartmentEventListener.
 */
class DepartmentEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('department')
            ->performedOn($event->department)
            ->withProperties(['name' => $event->department->name])
            ->log(':causer.name creó el departamento :subject.name');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        activity('department')
            ->performedOn($event->department)
            ->withProperties(['name' => $event->department->name])
            ->log(':causer.name modificó el departamento :subject.name');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        activity('department')
            ->performedOn($event->department)
            ->log(':causer.name eliminó el departamento :subject.name');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            DepartmentCreated::class,
            'App\Domains\Auth\Listeners\DepartmentEventListener@onCreated'
        );

        $events->listen(
            DepartmentUpdated::class,
            'App\Domains\Auth\Listeners\DepartmentEventListener@onUpdated'
        );

        $events->listen(
            DepartmentDeleted::class,
            'App\Domains\Auth\Listeners\DepartmentEventListener@onDeleted'
        );
    }
}
