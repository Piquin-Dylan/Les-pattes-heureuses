<?php

namespace App\Livewire\Form;

use App\Models\message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    #[Validate('required', message: 'Le champs prénom est requis')]
    public string $firstName = "";

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $lastName = "";

    #[Validate('required|email', message: 'Le champs email est requis')]
    public string $email = "";

    #[Validate('required', message: 'Le champs téléphone est requis')]
    public string $phone = "";

    #[Validate('required', message: 'Le champs objet est requis')]
    public string $object = "";

    #[Validate('required', message: 'Le champs message est requis')]
    public string $message = "";


    public function submit(): void
    {
        $this->validate();


        Message::create([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'object' => $this->object,
            'message' => $this->message,
        ]);
    }
}
