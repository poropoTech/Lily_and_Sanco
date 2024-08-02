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

    public function __construct(Comment $comment)
    {
        $this->response = $comment->owner;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('¡Han comentado uno de tus desafíos!'))
            ->greeting('¡Hola!')
            ->line(__('Un compañero ha comentado uno de tus desafíos en la plataforma CONCIENCIAR.
                            Si quieres ver su comentario accede a tu desafío pulsando sobre el botón siguiente.'))
            ->action(__('Ver el desafío'), route('frontend.pages.activity', ['activity' => $this->response->activity_id]));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
