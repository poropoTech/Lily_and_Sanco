<?php

namespace App\Domains\Statistics\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class IncompleteActivitiesNotification.
 */
class IncompleteActivitiesNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $stats;
    public $lang;

    public function __construct(array $stats, string $lang = 'es')
    {
        $this->stats = $stats;
        $this->lang = $lang;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('notification_incomplete_activities.subject', [], $this->lang))
            ->greeting(__('notification_incomplete_activities.greeting', [], $this->lang))
            ->line(__('notification_incomplete_activities.text', [], $this->lang))
            ->action(__('notification_incomplete_activities.action', [], $this->lang), route('frontend.user.challenges'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
