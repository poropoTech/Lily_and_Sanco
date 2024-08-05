<?php

namespace App\Domains\Responses\Notifications\Frontend;

use App\Domains\Common\Models\Comment;
use App\Domains\Responses\Models\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class NewResponseCommentNotification.
 */
class NewResponseCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $response;
    public $lang;

    public function __construct(Comment $comment, string $lang = 'es')
    {
        $this->response = $comment->owner;
        $this->lang = $lang;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('notification_new_response.subject', [], $this->lang))
            ->greeting(__('notification_new_response.greeting', [], $this->lang))
            ->line(__('notification_new_response.text', [], $this->lang))
            ->action(__('notification_new_response.action', [], $this->lang), route('frontend.pages.activity', ['activity' => $this->response->activity_id]));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
