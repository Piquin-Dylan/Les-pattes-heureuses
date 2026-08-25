<?php

namespace App\Notifications;

use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdoptionInProgressNotification extends Notification
{
    use Queueable;

    public Adoption $adoption;

    /**
     * Create a new notification instance.
     */
    public function __construct(Adoption $adoption)
    {
        $this->adoption = $adoption;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre demande d’adoption a été prise en compte')
            ->greeting('Bonjour ' . $this->adoption->firstName . ',')
            ->line('Bonne nouvelle : votre demande d’adoption concernant **' . $this->adoption->animal->name . '** a bien été prise en compte par notre équipe.')
            ->line('Un membre du refuge Les Pattes Heureuses va prochainement vous recontacter afin d’organiser la suite de votre démarche.')
            ->action('Nous contacter', route('public.contact'))
            ->line('Merci pour votre patience et à très vite !')
            ->salutation('L’équipe du refuge Les Pattes Heureuses');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
