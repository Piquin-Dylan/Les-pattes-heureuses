<?php

namespace App\Livewire\Form;

use App\Models\adoption;
use App\Models\Animal;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAdoption extends Form
{

    #[Validate('required', message: 'Le champs prénom est requis')]
    public string $firstName = "";

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $lastName = "";

    #[Validate('required', message: 'Le champs email est requis')]
    public string $email = "";

    #[Validate('required', message: 'Le champs téléphone est requis')]
    public string $phone = "";

    #[Validate('required', message: 'Le champs message est requis')]
    public string $message = "";


    public function submit(Animal $animal): void
    {
        $this->validate();


        Adoption::create([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'animal_id'=> $animal->id
        ]);
    }
}
