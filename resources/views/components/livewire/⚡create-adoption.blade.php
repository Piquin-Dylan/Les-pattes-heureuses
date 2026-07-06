<?php

use App\Livewire\Form\CreateAdoption;
use Livewire\Component;

new class extends Component {

    public \App\Models\Animal $animal;

    public CreateAdoption $form;

    public function save(): void
    {
        $this->form->validate();
        $this->form->submit($this->animal);
    }

};
?>

<div class="w-full px-4 py-6">

    <section class="mb-8">
        <x-page-header
            title="Modifier l'animal"
            description="Modifiez les informations de l'animal."/>

        <span>{{$animal->name}}</span>
        <form
            wire:submit.prevent="save"
            class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="mb-6 text-xl font-semibold text-gray-800">
                Informations de l'animal
            </h2>

            <div class="grid gap-5 lg:grid-cols-2">

                <x-form.input
                    label_name="Nom"
                    for_label="firstName"
                    type="text"
                    id="firstName"
                    name="firstName"
                    wire:model.live="form.firstName"
                />

                <x-form.input
                    label_name="Nom de famille"
                    for_label="lastName"
                    type="text"
                    id="lastName"
                    name="lastName"
                    wire:model.live="form.lastName"
                />

                <x-form.input
                    label_name="Adresse email"
                    for_label="email"
                    type="email"
                    id="email"
                    name="email"
                    wire:model.live="form.email"
                />

                <x-form.input
                    label_name="Numéros de téléphone"
                    for_label="tel"
                    type="tel"
                    id="tel"
                    name="tel"
                    wire:model.live="form.phone"
                />

            </div>

            <div class="mt-6">

                <x-form.input
                    label_name="Message"
                    for_label="message"
                    type="text"
                    id="message"
                    name="message"
                    wire:model.live="form.message"
                />

            </div>



            <div class="mt-10 flex justify-end">

                <button
                    type="submit"
                    class="w-full cursor-pointer rounded-2xl bg-[#C67C47] px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-[#b56f3c] active:scale-95 lg:w-auto">

                    Demande d'adoption
                </button>

            </div>

        </form>
    </section>
</div>

