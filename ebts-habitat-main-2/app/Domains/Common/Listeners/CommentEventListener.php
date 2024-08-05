<?php

namespace App\Domains\Common\Listeners;

use App\Domains\Common\Events\Comment\CommentCreated;
use App\Domains\Common\Events\Comment\CommentDeleted;
use App\Domains\Common\Events\Comment\CommentVerified;
use App\Domains\Notifications\Services\NotificationService;
use App\Domains\Responses\Models\Response;

/**
 * Class CommentEventListener.
 */
class CommentEventListener
{
    protected NotificationService $notificationService;

    /**
     * CommentEventListener constructor.
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
        activity('comment')
            ->performedOn($event->comment)
            ->withProperties(['id' => $event->comment->id])
            ->log(':causer.name creó el comentario con identificador:subject.id');

        $ownerType = $event->comment->owner_type;
        switch ($ownerType) {
            case Response::class:
                $this->notificationService->newResponseComment($event->comment);
                break;
        }
    }

    public function onDeleted($event)
    {
        activity('comment')
            ->performedOn($event->comment)
            ->withProperties(['id' => $event->comment->id])
            ->log(':causer.name eliminó el comentario con identificador:subject.id');
    }

    /**
     * @param $event
     */
    public function onVerified($event)
    {
        activity('comment')
            ->performedOn($event->comment)
            ->withProperties(['name' => $event->comment->name])
            ->log(':causer.name verificó el comentario :subject.name');
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            CommentCreated::class,
            'App\Domains\Common\Listeners\CommentEventListener@onCreated'
        );

        $events->listen(
            CommentDeleted::class,
            'App\Domains\Common\Listeners\CommentEventListener@onDeleted'
        );

        $events->listen(
            CommentVerified::class,
            'App\Domains\Common\Listeners\CommentEventListener@onVerified'
        );
    }
}
