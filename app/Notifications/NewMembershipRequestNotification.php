<?php

namespace App\Notifications;

use App\Enums\DayOfWeek;
use App\Models\MembershipRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMembershipRequestNotification extends Notification
{
    use Queueable;

    public MembershipRequest $membershipRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(MembershipRequest $membershipRequest)
    {
        $this->membershipRequest = $membershipRequest;
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
        $mail = (new MailMessage)
            ->mailer('mailtrap')
            ->subject('Nouvelle demande pour devenir membre')
            ->greeting('Bonjour,')
            ->line('Une nouvelle demande pour devenir membre a été envoyée depuis le site Les Pattes Heureuses.')
            ->line('Demandeur : ' . $this->membershipRequest->firstName . ' ' . $this->membershipRequest->lastName)
            ->line('E-mail : ' . $this->membershipRequest->email)
            ->line('Téléphone : ' . $this->membershipRequest->phone)
            ->line('Disponibilités : ' . $this->availabilitiesLabel());

        if ($this->membershipRequest->message) {
            $mail->line('Message :')->line($this->membershipRequest->message);
        }

        return $mail->line('Vous pouvez contacter directement le demandeur grâce à son adresse e-mail ou à son numéro de téléphone.');
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

    private function availabilitiesLabel(): string
    {
        $days = collect($this->membershipRequest->availabilities ?? [])
            ->map(fn (string $day) => DayOfWeek::from($day)->label());

        return $days->isNotEmpty() ? $days->implode(', ') : 'Non renseignées';
    }
}
