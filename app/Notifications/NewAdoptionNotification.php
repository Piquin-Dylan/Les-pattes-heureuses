<?php

namespace App\Notifications;

use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdoptionNotification extends Notification
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
            ->subject('Nouvelle demande d’adoption')
            ->greeting('Bonjour,')
            ->line('Une nouvelle demande d’adoption a été envoyée depuis le site Les Pattes Heureuses.')
            ->line('Animal concerné : ' . $this->adoption->animal->name)
            ->line('Demandeur : ' . $this->adoption->firstName . ' ' . $this->adoption->lastName)
            ->line('E-mail : ' . $this->adoption->email)
            ->line('Téléphone : ' . $this->adoption->phone)
            ->line('Message :')
            ->line($this->adoption->message)
            ->action('Voir les demandes d’adoption', route('adoption.fiche', $this->adoption))
            ->line('Vous pouvez contacter directement le demandeur grâce à son adresse e-mail ou à son numéro de téléphone.');
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
