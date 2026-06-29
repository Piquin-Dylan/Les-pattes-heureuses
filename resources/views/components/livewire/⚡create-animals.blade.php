<?php

use App\Livewire\Form\CreateAnimal;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {

    public CreateAnimal $form;

    public Collection $race;


    public function mount(): void
    {
        $this->race = collect([]);
    }

    public function updateBreeds(): void
    {
        $this->race = \App\Models\Breed::where('breeds.species', $this->form->species)->get();
    }

    public function save(): void
    {
        $this->form->validate();
        $this->form->submit();
    }

    public function updated($property): void
    {
        if ($property === 'form.species') {
            $this->updateBreeds();
            $this->form->raceChoice = '';
        }
    }
};
?>

<div>
    <form
        wire:submit.prevent="save"
        class="space-y-2">

        <x-form.input
            label_name="Nom de l'animal"
            for_label="name"
            placeholder="Ex : Maya"
            type="text"
            id="name"
            name="name"
            wire:model.live="form.name"
        />

        <x-form.input
            label_name="Description"
            for_label="description"
            placeholder="Ex : il est gentil"
            type="text"
            id="description"
            name="description"
            wire:model.live="form.description"/>

        <x-form.input
            label_name="photo de l'animal"
            for_label="photo"
            placeholder=""
            type="file"
            id="photo"
            name="photo"
            wire:model.live="form.photo"/>

        <x-form.input
            label_name="age de l'animal"
            for_label="age"
            placeholder=""
            type="date"
            id="age"
            name="age"
            wire:model.live="form.age"/>


        <x-form.select
            label_name="Sexe"
            for_label="sexe"
            name="sexe"
            id="sexe"
            :options="\App\Enums\SexAnimal::cases()"
            wire:model.live="form.sexe"/>

        <x-form.select
            label_name="Statut"
            for_label="status"
            name="status"
            id="status"
            :options="\App\Enums\StatusAnimal::cases()"
            wire:model.live="form.status"/>
        <x-form.select
            label_name="Espèce"
            for_label="species"
            name="species"
            id="species"
            :options="\App\Enums\SpeciesAnimal::cases()"
            wire:model.live="form.species"/>
        <x-form.select
            label_name="Pellage"
            for_label="coat"
            name="coat"
            id="coat"
            :options="\App\Enums\CoatAnimal::cases()"
            wire:model.live="form.coat"/>

        @if($this->form->species)

                <x-form.select
                    label_name="Race de l'animale"
                    for_label="breed"
                    name="breed"
                    id="breed"
                    wire:model.live="form.raceChoice"
                    :options="$this->race"
                />

        @endif

        <button
            type="submit"
            class="mt-6 w-full rounded-2xl bg-[#C67C47] py-4 font-semibold text-white shadow-lg transition duration-300 hover:bg-[#A96534] active:scale-95 cursor-pointer">
            Créer l'animal
        </button>
    </form>
</div>
