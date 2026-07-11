<?php

namespace App\Notifications;

use http\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFormContactNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail(object $notifiable,): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau message de contact')
            ->greeting('Bonjour,')
            ->line('Un nouveau message de contact a été envoyé depuis le site Les Pattes Heureuses.')
            ->line('Expéditeur : ' . $this->message->firstName . ' ' . $this->message->lastName)
            ->line('E-mail : ' . $this->message->email)
            ->line('Téléphone : ' . $this->message->phone)
            ->line('Objet : ' . $this->message->object)
            ->line('Message :')
            ->line($this->message->message)
            ->action('Voir les messages', route('messages'))
            ->line('Vous pouvez répondre directement au demandeur à l’aide de son adresse e-mail ou de son numéro de téléphone.');
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
