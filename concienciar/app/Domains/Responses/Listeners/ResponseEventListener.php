<?php

namespace App\Domains\Responses\Listeners;

use App\Domains\Responses\Events\ResponseCreated;
use App\Domains\Responses\Events\ResponseDeleted;
use App\Domains\Responses\Events\ResponsePublished;
use App\Domains\Responses\Events\ResponseUnpublished;
use App\Domains\Responses\Events\ResponseVerified;

/**
 * Class ResponseEventListener.
 */
class ResponseEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('response')
            ->performedOn($event->response)
            ->withProperties(['id' => $event->response->id])
            ->log(':causer.name creó la respuesta con identificador:subject.id');
    }

    public function onPublished($event)
    {
        activity('response')
            ->performedOn($event->response)
            ->withProperties(['id' => $event->response->id])
            ->log(':causer.name publicó la respuesta con identificador:subject.id');
    }

    public function onUnpublished($event)
    {
        activity('response')
            ->performedOn($event->response)
            ->withProperties(['id' => $event->response->id])
            ->log(':causer.name despublicó la respuesta con identificador:subject.id');
    }

    public function onDeleted($event)
    {
        activity('response')
            ->performedOn($event->response)
            ->withProperties(['id' => $event->response->id])
            ->log(':causer.name eliminó la respuesta con identificador:subject.id');
    }

    /**
     * @param $event
     */
    public function onVerified($event)
    {
        activity('response')
            ->performedOn($event->response)
            ->withProperties(['name' => $event->response->name])
            ->log(':causer.name verificó la respuesta :subject.name');
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ResponseCreated::class,
            'App\Domains\Responses\Listeners\ResponseEventListener@onCreated'
        );

        $events->listen(
            ResponsePublished::class,
            'App\Domains\Responses\Listeners\ResponseEventListener@onPublished'
        );

        $events->listen(
            ResponseUnpublished::class,
            'App\Domains\Responses\Listeners\ResponseEventListener@onUnpublished'
        );

        $events->listen(
            ResponseDeleted::class,
            'App\Domains\Responses\Listeners\ResponseEventListener@onDeleted'
        );

        $events->listen(
            ResponseVerified::class,
            'App\Domains\Responses\Listeners\ResponseEventListener@onVerified'
        );

    }
}
