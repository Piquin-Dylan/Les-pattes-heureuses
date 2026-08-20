<?php

use App\Livewire\Form\EditMember;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public EditMember $form;

    public function mount(User $member): void
    {
        $this->form->setMember($member);
    }

    public function save()
    {
        $member = $this->form->update();

        return redirect()->route('members.fiche', $member);
    }
};
?>

<div class="w-full px-0 py-6 sm:px-4">

    <section class="mb-8">
        <x-page-header
            title="Modifier le membre"
            description="Modifiez les informations de la personne."
        />

        <form
            wire:submit.prevent="save"
            class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="mb-6 text-xl font-semibold text-gray-800">
                Informations de la personne
            </h2>

            <div class="grid gap-5 lg:grid-cols-2">

                <x-form.input
                    label_name="Nom"
                    for_label="lastName"
                    type="text"
                    id="lastName"
                    name="lastName"
                    wire:model.live="form.lastName"/>

                <x-form.input
                    label_name="Prénom"
                    for_label="firstName"
                    type="text"
                    id="firstName"
                    name="firstName"
                    wire:model.live="form.firstName"/>

                <x-form.input
                    label_name="Adress mail"
                    for_label="email"
                    type="email"
                    id="email"
                    name="email"
                    wire:model.live="form.email"/>

                <x-form.select
                    label_name="Role"
                    for_label="role"
                    name="role"
                    id="role"
                    :options="\App\Enums\Members::cases()"
                    wire:model.live="form.status"/>

                <x-form.input
                    label_name="Numéros de téléphone"
                    for_label="phone"
                    type="tel"
                    id="phone"
                    name="phone"
                    wire:model.live="form.phone"/>
            </div>

            <div class="mt-6">

                @if($form->currentPhoto)
                    <div class="mb-4">
                        <p class="mb-2 text-sm font-medium text-gray-700">
                            Photo actuelle
                        </p>

                        <img
                            src="{{ asset('storage/animals/'.$form->currentPhoto.'/thumb.webp') }}"
                            alt="Photo actuelle de {{ $form->firstName }}"
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
                    wire:model.live="form.photo"/>

                <p class="mt-2 text-sm text-gray-500">
                    Laissez vide pour conserver la photo actuelle.
                </p>

            </div>

            <div class="mt-8">

                <h2 class="mb-1 text-xl font-semibold text-gray-800">
                    Disponibilités
                </h2>

                <p class="mb-4 text-sm text-gray-500">
                    Cochez les créneaux où la personne est disponible.
                </p>

                <x-form.availability-picker
                    :schedule="$form->availabilities"
                    name="form.availabilities"/>

            </div>

            <div class="mt-10 flex justify-end">

                <button
                    type="submit"
                    class="w-full cursor-pointer rounded-2xl bg-[#C67C47] px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-[#b56f3c] active:scale-95 lg:w-auto">

                    Modifier le membre

                </button>

            </div>

        </form>
    </section>
</div>
