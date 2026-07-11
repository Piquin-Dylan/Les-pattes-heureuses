<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFormContactNotification extends Notification
{
    use Queueable;

    public \App\Models\Message $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(\App\Models\Message $message)
    {
        $this->message = $message;
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
            ->line('Un nouveau message de contact a été envoyé depuis le formulaire de contact du site les pattes heureuses')
            ->line('Expéditeur : ' . $this->message->firstName . ' ' . $this->message->lastName)
            ->line('E-mail : ' . $this->message->email)
            ->line('Téléphone : ' . $this->message->phone)
            ->line('Objet : ' . $this->message->object)
            ->line('Message :')
            ->line($this->message->message)
            ->action('Voir les messages', route('message'));
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
