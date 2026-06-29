<?php

namespace App\Livewire\Form;

use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAnimal extends Form
{


    #[Validate('required', message: 'Le champs nom est requis')]
    public string $name = "";

    #[Validate('required', message: 'Le champs description est requis')]
    public string $description = "";

    public string $photo = "";

    #[Validate('required', message: 'Le champs age est requis')]
    public string $age = "";


    public function submit(): void
    {
        $this->validate();

        Animal::create([
            'name' => $this->name,
            'description' => $this->description,
            'photo' => $this->photo,
            'age' => $this->age
        ]);
    }
}
