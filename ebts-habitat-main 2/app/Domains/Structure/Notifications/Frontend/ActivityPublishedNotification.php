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

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('¡Tienes nuevos desafíos!'))
            ->greeting('¡Hola!')
            ->greeting('')
            ->line(__('Tienes un nuevo desafío en la plataforma CONCIENCIAR. Tan sólo te
                            llevará unos minutos completarlo, y estamos seguros de que te
                            ayudará a sentirte más cerca de tus compañeros mientras asimilas
                            nuevos hábitos y experiencias para tu propio bienestar y el de nuestro
                            planeta. Además, entre todos conseguiremos alcanzar el objetivo que
                            nos hemos marcado. Tu implicación es clave para conseguirlo.'))
            ->action(__('Ver el desafío'), route('frontend.pages.activity', ['activity' => $this->activity->id]));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
