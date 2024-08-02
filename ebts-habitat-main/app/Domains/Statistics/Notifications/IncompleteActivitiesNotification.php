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

    public function __construct(array $stats)
    {
        $this->stats = $stats;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('¡Tienes desafíos pendientes!'))
            ->greeting('¡Hola!')
            ->line(__('Tienes desafíos pendientes en la plataforma CONCIENCIAR. Tan sólo te
            llevará unos minutos completar alguno de ellos, y estamos seguros de que te
            ayudará a sentirte más cerca de tus compañeros mientras asimilas
            nuevos hábitos y experiencias para tu propio bienestar y el de nuestro
            planeta. Además, entre todos conseguiremos alcanzar el objetivo que nos hemos marcado.
            Tu implicación es clave para conseguirlo.'))
            ->action(__('Ver mis desafíos'), route('frontend.user.challenges'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
