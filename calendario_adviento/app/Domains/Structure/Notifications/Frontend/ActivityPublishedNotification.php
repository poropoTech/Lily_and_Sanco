<?php

namespace App\Domains\Structure\Notifications\Frontend;

use App\Domains\Structure\Models\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class ActivityPublishedNotification.
 */
class ActivityPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $activity;
    public $lang;

    public function __construct(Activity $activity, string $lang = 'es')
    {
        $this->activity = $activity;
        $this->lang = $lang;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('notification_activity_published.subject', [], $this->lang))
            ->greeting(__('notification_activity_published.greeting', [], $this->lang))
            ->greeting('')
            ->line(__('notification_activity_published.text', [], $this->lang))
            ->action(__('notification_activity_published.action', [], $this->lang), route('frontend.pages.activity', ['activity' => $this->activity->id]));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
