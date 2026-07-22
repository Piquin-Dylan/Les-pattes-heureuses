<?php

namespace App\Notifications;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnimalSubmittedNotification extends Notification
{
    use Queueable;

    public Animal $animal;

    public User $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(Animal $animal, User $user)
    {
        $this->animal = $animal;
        $this->user = $user;
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
            ->subject('Nouvelle fiche animal à valider')
            ->greeting('Bonjour,')
            ->line($this->user->firstName . ' ' . $this->user->lastName . ' a créé une nouvelle fiche pour "' . $this->animal->name . '".')
            ->line('Informations de la fiche :')
            ->line('Nom : ' . $this->animal->name)
            ->line('Espèce : ' . $this->animal->species)
            ->line('Statut : ' . $this->animal->status)
            ->line('Cette fiche est actuellement en attente de validation avant sa publication sur le site.')
            ->action('Voir la fiche', route('animals.show', $this->animal))
            ->line('Merci de la vérifier et de la valider si toutes les informations sont correctes.');
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
