<?php

namespace App\Livewire\Form;

use App\Models\Animal;
use App\Services\ImageService;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditAnimal extends Form
{
    public ?Animal $animal = null;

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $name = "";

    #[Validate('required', message: 'Le champs description est requis')]
    public string $description = "";

    #[Validate('nullable|image|max:5120')]
    public ?TemporaryUploadedFile $photo = null;

    public ?string $currentPhoto = null;

    #[Validate('required', message: 'Le champs age est requis')]
    public string $age = "";

    #[Validate('required', message: 'Le champs sexe est requis')]
    public string $sexe = "";

    #[Validate('required', message: 'Le champs statut est requis')]
    public string $status = "";

    #[Validate('required', message: 'Le champs espèce est requis')]
    public string $species = "";

    #[Validate('required', message: 'Le champs pelage est requis')]
    public string $coat = "";

    public string $raceChoice = "";

    public string $vaccineChoice = "";


    public function setAnimal(Animal $animal): void
    {
        $this->animal = $animal;

        $this->name = $animal->name;
        $this->description = $animal->description;
        $this->currentPhoto = $animal->photo;
        $this->age = $animal->age;
        $this->sexe = $animal->sex;
        $this->status = $animal->status;
        $this->species = $animal->species;
        $this->coat = $animal->coat;
    }


    public function update(ImageService $imageService): Animal
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'age' => $this->age,
            'sexe' => $this->sexe,
            'status' => $this->status,
            'species' => $this->species,
            'coat' => $this->coat,
        ];

        if ($this->photo) {
            $data['photo'] = $imageService->storeAnimalImage($this->photo);
        }

        $this->animal->update($data);

        return $this->animal;
    }
}
