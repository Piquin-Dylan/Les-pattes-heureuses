<?php

namespace App\Livewire\Form;

use App\Models\Animal;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Services\ImageService;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateAdoption extends Form
{

    #[Validate('required', message: 'Le champs prénom est requis')]
    public string $firstName = "";

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $lastName = "";

    #[Validate('required', message: 'Le champs email est requis')]
    public string $email = "";

    #[Validate('required', message: 'Le champs description est requis')]
    public string $description = "";



    public function submit(ImageService $imageService): void
    {
        $this->validate();

        $photo = $imageService->storeAnimalImage($this->photo);

        Animal::create([
            'name' => $this->name,
            'description' => $this->description,
            'photo' => $photo,
            'age' => $this->age,
            'sex' => $this->sexe,
            'status' => $this->status,
            'species' => $this->species,
            'coat' => $this->coat,
            'breed_id' => $this->raceChoice,
            'vaccine_id' => $this->vaccineChoice,
        ]);
    }
}
