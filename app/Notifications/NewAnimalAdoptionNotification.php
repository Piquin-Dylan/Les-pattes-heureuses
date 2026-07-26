<?php

namespace App\Notifications;

use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAnimalAdoptionNotification extends Notification
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
            ->subject('Votre demande d’adoption a bien été reçue')
            ->greeting('Bonjour ' . $this->adoption->firstName . ',')
            ->line('Nous vous remercions pour l’intérêt que vous portez à nos animaux et pour votre demande concernant **' . $this->adoption->animal->name . '**.')
            ->line('Votre demande a bien été enregistrée et a été transmise à notre équipe.')
            ->line('Un membre du refuge Les Pattes Heureuses reprendra prochainement contact avec vous afin d’organiser une première rencontre ou de répondre à vos questions concernant l’adoption.')
            ->action('Nous contacter', route('public.contact'))
            ->line('Merci pour votre confiance et à bientôt !')
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
