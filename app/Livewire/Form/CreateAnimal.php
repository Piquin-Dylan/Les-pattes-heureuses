<?php

namespace App\Livewire\Form;

use App\Models\Animal;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Services\ImageService;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateAnimal extends Form
{

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $name = "";

    #[Validate('required', message: 'Le champs description est requis')]
    public string $description = "";

    #[Validate('required|image|max:5120')]
    public ?TemporaryUploadedFile $photo = null;

    #[Validate('required', message: 'Le champs age est requis')]
    public string $age = "";

    #[Validate('required', message: 'Le champs sexe est requis')]
    public string $sexe = "";

    #[Validate('required', message: 'Le champs status est requis')]
    public string $status = "";

    #[Validate('required', message: 'Le champs espèces est requis')]
    public string $species = "";

    #[Validate('required', message: 'Le champs pellage est requis')]
    public string $coat = "";

    #[Validate('required', message: 'Le champs race est requis')]
    public string $raceChoice = "";

    #[Validate('required', message: 'Le champs vaccin est requis')]
    public string $vaccineChoice = "";


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
            'slug' => Str::slug($this->name),
        ]);
    }
}
