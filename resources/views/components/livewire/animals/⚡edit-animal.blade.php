<?php

use App\Livewire\Form\EditAnimal;
use App\Models\Animal;
use App\Services\ImageService;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public EditAnimal $form;

    public Collection $race;

    public Collection $vaccine;

    public function mount(Animal $animal): void
    {
        $this->form->setAnimal($animal);
        $this->race = collect([]);
        $this->vaccine = collect([]);
    }

    public function save(ImageService $imageService)
    {
        $animal = $this->form->update($imageService);

        return redirect()->route('animals.show', [
            'animal' => $animal->id
        ]);
    }
};
?>

<div class="w-full px-4 py-6">

    <section class="mb-8">
        <x-page-header
            title="Modifier l'animal"
            description="Modifiez les informations de l'animal."
        />

        <form
            wire:submit.prevent="save"
            class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="mb-6 text-xl font-semibold text-gray-800">
                Informations de l'animal
            </h2>

            <div class="grid gap-5 lg:grid-cols-2">

                <x-form.input
                    label_name="Nom"
                    for_label="name"
                    placeholder="Ex : Maya"
                    type="text"
                    id="name"
                    name="name"
                    wire:model.live="form.name"
                />

                <x-form.input
                    label_name="Date de naissance"
                    for_label="age"
                    type="date"
                    id="age"
                    name="age"
                    wire:model.live="form.age"
                />

                <x-form.select
                    label_name="Espèce"
                    for_label="species"
                    name="species"
                    id="species"
                    :options="\App\Enums\SpeciesAnimal::cases()"
                    wire:model.live="form.species"
                />

                <x-form.select
                    label_name="Sexe"
                    for_label="sexe"
                    name="sexe"
                    id="sexe"
                    :options="\App\Enums\SexAnimal::cases()"
                    wire:model.live="form.sexe"
                />

                <x-form.select
                    label_name="Statut"
                    for_label="status"
                    name="status"
                    id="status"
                    :options="\App\Enums\StatusAnimal::cases()"
                    wire:model.live="form.status"
                />

                <x-form.select
                    label_name="Pelage"
                    for_label="coat"
                    name="coat"
                    id="coat"
                    :options="\App\Enums\CoatAnimal::cases()"
                    wire:model.live="form.coat"
                />

                <x-form.select
                    label_name="Race"
                    for_label="breed"
                    name="breed"
                    id="breed"
                    wire:model.live="form.raceChoice"
                    :options="$this->race"
                />

                <x-form.select
                    label_name="Vaccin"
                    for_label="vaccine"
                    name="vaccine"
                    id="vaccine"
                    wire:model.live="form.vaccineChoice"
                    :options="$this->vaccine"
                />

            </div>

            <div class="mt-6">

                <x-form.input
                    label_name="Description"
                    for_label="description"
                    placeholder="Décrivez le caractère, les habitudes ou toute information utile..."
                    type="text"
                    id="description"
                    name="description"
                    wire:model.live="form.description"
                />

            </div>

            <div class="mt-6">

                @if($form->currentPhoto)
                    <div class="mb-4">
                        <p class="mb-2 text-sm font-medium text-gray-700">
                            Photo actuelle
                        </p>

                        <img
                            src="{{ asset('storage/' . $form->currentPhoto) }}"
                            alt="Photo actuelle de {{ $form->name }}"
                            class="h-32 w-32 rounded-2xl object-cover"
                        >
                    </div>
                @endif

                <x-form.input
                    label_name="Nouvelle photo"
                    for_label="photo"
                    type="file"
                    id="photo"
                    name="photo"
                    wire:model.live="form.photo"
                />

                <p class="mt-2 text-sm text-gray-500">
                    Laissez vide pour conserver la photo actuelle.
                </p>

            </div>

            <div class="mt-10 flex justify-end">

                <button
                    type="submit"
                    class="w-full cursor-pointer rounded-2xl bg-[#C67C47] px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-[#b56f3c] active:scale-95 lg:w-auto">

                    Modifier l'animal

                </button>

            </div>

        </form>
    </section>
</div>
