<?php

namespace App\Livewire\Form;

use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Services\ImageService;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditAnimal extends Form
{

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $name = "";

    #[Validate('required', message: 'Le champs description est requis')]
    public string $description = "";

    #[Validate('required|image|max:5120')]
    public ?TemporaryUploadedFile $photo = null;

    #[Validate('required', message: 'Le champs age est requis')]
    public string $age = "";

    #[Validate('required', message: 'Le champs age est requis')]
    public string $sexe = "";

    #[Validate('required', message: 'Le champs age est requis')]
    public string $status = "";

    #[Validate('required', message: 'Le champs age est requis')]
    public string $species = "";

    #[Validate('required', message: 'Le champs age est requis')]
    public string $coat = "";

    #[Validate('required', message: 'Le champs age est requis')]
    public string $raceChoice = "";

    #[Validate('required', message: 'Le champs age est requis')]
    public string $vaccineChoice = "";


    public function mount(Animal $animal): void
    {
        $this->name = $animal->name;
        $this->description = $animal->description;
        $this->photo = $animal->photo;
        $this->age = $animal->description;
        $this->sexe = $animal->description;
        $this->status = $animal->description;
        $this->species = $animal->species;
        $this->coat = $animal->coat;
    }


    public function update(): void
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

        if ($this->image) {
            $data['image'] = $this->image->store('photos', 'public');
        }

        Auth::user()->update($data);

        $this->reset('image');
    }
}
