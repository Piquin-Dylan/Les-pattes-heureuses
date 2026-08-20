<?php

use App\Enums\StatusAnimal;
use App\Models\Animal;
use Livewire\Component;

new class extends Component {

    public ?int $animalId = null;

    public function mount(): void
    {
        $this->animalId = $this->animals->first()?->id;
    }

    public function getAnimalsProperty()
    {
        return Animal::where('status', StatusAnimal::ADOPTABLE->value)
            ->orderBy('name')
            ->get();
    }

    public function getSelectedAnimalProperty(): ?Animal
    {
        return $this->animalId
            ? $this->animals->firstWhere('id', $this->animalId)
            : null;
    }
};
?>

<div class="w-full px-0 py-6 sm:px-4">

    <x-page-header
        title="Nouvelle adoption"
        description="Sélectionnez l'animal concerné par cette demande d'adoption."/>

    <div class="mt-6 max-w-md rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

        <x-form.select
            label_name="Animal"
            for_label="animalId"
            name="animalId"
            id="animalId"
            :options="$this->animals"
            wire:model.live="animalId"/>

    </div>

    @if($this->selectedAnimal)
        <div class="mt-8">
            <livewire:livewire.create-adoption
                :animal="$this->selectedAnimal"
                :key="'new-adoption-'.$this->selectedAnimal->id"/>
        </div>
    @else
        <p class="mt-6 text-gray-500">
            Aucun animal disponible à l'adoption pour le moment.
        </p>
    @endif

</div>
