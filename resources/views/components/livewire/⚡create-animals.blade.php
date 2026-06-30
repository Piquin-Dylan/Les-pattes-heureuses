<?php

use App\Livewire\Form\CreateAnimal;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {

    public CreateAnimal $form;

    public Collection $race;

    public Collection $vaccine;


    public function mount(): void
    {
        $this->race = collect([]);
        $this->vaccine = collect([]);
    }

    public function updateBreeds(): void
    {
        $this->race = \App\Models\Breed::where('species', $this->form->species)->get();
        $this->vaccine = \App\Models\Vaccine::where('species', $this->form->species)->get();
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
            $this->form->vaccineChoice = '';
        }
    }
};
?>

<div class="mx-auto max-w-3xl px-4 py-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Ajouter un animal
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Complétez les informations de votre animal afin qu'il puisse être proposé à l'adoption.
        </p>
    </div>

    <form
        wire:submit.prevent="save"
        class="space-y-8">

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <h2 class="mb-5 text-lg font-semibold text-gray-800">
                Informations générales
            </h2>

            <div class="space-y-5">

                <x-form.input
                    label_name="Nom"
                    for_label="name"
                    placeholder="Ex : Maya"
                    type="text"
                    id="name"
                    name="name"
                    wire:model.live="form.name"/>

                <x-form.input
                    label_name="Description"
                    for_label="description"
                    placeholder="Décrivez brièvement votre animal..."
                    type="text"
                    id="description"
                    name="description"
                    wire:model.live="form.description"/>

                <x-form.input
                    label_name="Photo"
                    for_label="photo"
                    type="file"
                    id="photo"
                    name="photo"
                    wire:model.live="form.photo"/>

            </div>

        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <h2 class="mb-5 text-lg font-semibold text-gray-800">
                Caractéristiques
            </h2>

            <div class="grid gap-5 md:grid-cols-2">

                <x-form.input
                    label_name="Date de naissance"
                    for_label="age"
                    type="date"
                    id="age"
                    name="age"
                    wire:model.live="form.age"/>

                <x-form.select
                    label_name="Espèce"
                    for_label="species"
                    name="species"
                    id="species"
                    :options="\App\Enums\SpeciesAnimal::cases()"
                    wire:model.live="form.species"/>

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
                    label_name="Pelage"
                    for_label="coat"
                    name="coat"
                    id="coat"
                    :options="\App\Enums\CoatAnimal::cases()"
                    wire:model.live="form.coat"/>

            </div>

        </div>

        @if($this->form->species)

            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

                <h2 class="mb-5 text-lg font-semibold text-gray-800">
                    Informations spécifiques
                </h2>

                <div class="grid gap-5 md:grid-cols-2">

                    <x-form.select
                        label_name="Race"
                        for_label="breed"
                        name="breed"
                        id="breed"
                        wire:model.live="form.raceChoice"
                        :options="$this->race"/>

                    <x-form.select
                        label_name="Vaccin"
                        for_label="vaccine"
                        name="vaccine"
                        id="vaccine"
                        wire:model.live="form.vaccineChoice"
                        :options="$this->vaccine"/>

                </div>

            </div>

        @endif

        <div class="sticky bottom-4">

            <button
                type="submit"
                class="w-full rounded-2xl bg-[#C67C47] py-4 text-base font-semibold text-white shadow-xl transition hover:bg-[#b56f3c] active:scale-[0.98]">

                Ajouter l'animal

            </button>

        </div>

    </form>

</div>
