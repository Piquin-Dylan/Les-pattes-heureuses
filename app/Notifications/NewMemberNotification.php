<?php

namespace App\Notifications;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMemberNotification extends Notification
{
    use Queueable;

    public User $member;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $member)
    {
        $this->member = $member;
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
            ->subject('Votre compte Les Pattes Heureuses a été créé')
            ->greeting('Bonjour ' . $this->member->firstName . ',')
            ->line('Votre compte a bien été créé sur le site Les Pattes Heureuses.')
            ->line('Vous pouvez dès à présent vous connecter à votre espace personnel.')
            ->line('Adresse e-mail : ' . $this->member->email)
            ->line('Mot de passe : ' . $this->member->password)
            ->action('Accéder au site', url('/admin'))
            ->line('Une fois connecté, nous vous recommandons de modifier votre mot de passe ainsi que les informations de votre compte si nécessaire.')
            ->line('Nous vous souhaitons la bienvenue sur Les Pattes Heureuses !');
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
