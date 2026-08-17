<?php

namespace App\Livewire\Form;

use App\Enums\MembershipRequestStatus;
use App\Models\MembershipRequest;
use App\Notifications\NewMembershipRequestNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateMembershipRequest extends Form
{
    #[Validate('required', message: 'Le champs prénom est requis')]
    public string $firstName = "";

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $lastName = "";

    #[Validate('required|email', message: 'Le champs email est requis')]
    public string $email = "";

    #[Validate('required', message: 'Le champs téléphone est requis')]
    public string $phone = "";

    public string $message = "";

    #[Validate('required|array|min:1', message: 'Merci de sélectionner au moins une disponibilité')]
    public array $availabilities = [];

    public function submit(): void
    {
        $this->validate();

        $membershipRequest = MembershipRequest::create([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'availabilities' => $this->availabilities,
            'status' => MembershipRequestStatus::Pending->value,
        ]);

        Notification::route('mail', config('mail.refuge.address'))
            ->notify(new NewMembershipRequestNotification($membershipRequest));
    }
}
