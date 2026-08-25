<?php

use App\Livewire\Form\EditFormProfile;
use App\Livewire\Form\EditPasswordForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public EditFormProfile $form;
    public EditPasswordForm $passwordForm;

    public function mount(): void
    {
        $this->form->mount();
    }

    public function updateProfile(): void
    {
        $this->form->update();

        session()->flash('success', 'Profil mis à jour avec succès.');
    }

    public function updatePassword(): void
    {
        $this->passwordForm->update();

        session()->flash('success_password', 'Mot de passe mis à jour avec succès.');
    }
};
?>

<div class="space-y-8">

<div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm sm:p-8">

    <div class="mb-8">

        <h2 class="text-2xl font-bold text-gray-900">
            Mon profil
        </h2>

        <p class="mt-2 text-gray-500">
            Modifiez vos informations personnelles et votre photo de profil.
        </p>

    </div>

    @if (session()->has('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-8">

        <div class="grid gap-6 lg:grid-cols-2">

            <x-form.input
                label_name="Prénom"
                for_label="firstName"
                placeholder="Jean"
                type="text"
                id="firstName"
                name="firstName"
                wire:model="form.firstName" />

            <x-form.input
                label_name="Nom"
                for_label="lastName"
                placeholder="Dupont"
                type="text"
                id="lastName"
                name="lastName"
                wire:model="form.lastName" />

        </div>

        <div class="grid gap-6 lg:grid-cols-2">

            <x-form.input
                label_name="Adresse e-mail"
                for_label="email"
                placeholder="jean.dupont@gmail.com"
                type="email"
                id="email"
                name="email"
                wire:model="form.email" />

            <x-form.input
                label_name="Photo de profil"
                for_label="photo"
                type="file"
                id="photo"
                name="photo"
                wire:model="form.image" />

        </div>

        @if($form->image)

            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">

                <p class="mb-4 text-sm font-medium text-gray-700">
                    Prévisualisation
                </p>

                <div class="flex justify-center">

                    <img
                        src="{{ $form->image->temporaryUrl() }}"
                        alt="Prévisualisation"
                        class="h-32 w-32 rounded-full border-4 border-white object-cover shadow-md">

                </div>

            </div>

        @elseif(Auth::user()->photo)

            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">

                <p class="mb-4 text-sm font-medium text-gray-700">
                    Photo actuelle
                </p>

                <div class="flex justify-center">

                    <img
                        src="{{ asset('storage/animals/'.Auth::user()->photo.'/320.webp') }}"
                        alt="Photo de profil"
                        class="h-32 w-32 rounded-full border-4 border-white object-cover shadow-md">

                </div>

            </div>

        @endif

        <div class="flex justify-end">

            <button
                type="submit"
                class="w-full rounded-2xl bg-[#C67C47] px-8 py-3 font-semibold text-white transition hover:bg-[#B56F3C] sm:w-auto">

                Enregistrer les modifications

            </button>

        </div>

    </form>

</div>

<div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm sm:p-8">

    <div class="mb-8">

        <h2 class="text-2xl font-bold text-gray-900">
            Mot de passe
        </h2>

        <p class="mt-2 text-gray-500">
            Modifiez votre mot de passe de connexion.
        </p>

    </div>

    @if (session()->has('success_password'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
            {{ session('success_password') }}
        </div>
    @endif

    <form wire:submit.prevent="updatePassword" class="space-y-8">

        <x-form.input
            label_name="Mot de passe actuel"
            for_label="currentPassword"
            type="password"
            id="currentPassword"
            name="currentPassword"
            form_name="passwordForm"
            wire:model="passwordForm.currentPassword" />

        <div class="grid gap-6 lg:grid-cols-2">

            <x-form.input
                label_name="Nouveau mot de passe"
                for_label="password"
                type="password"
                id="password"
                name="password"
                form_name="passwordForm"
                wire:model="passwordForm.password" />

            <x-form.input
                label_name="Confirmer le nouveau mot de passe"
                for_label="password_confirmation"
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                form_name="passwordForm"
                wire:model="passwordForm.password_confirmation" />

        </div>

        <div class="flex justify-end">

            <button
                type="submit"
                class="w-full rounded-2xl bg-[#C67C47] px-8 py-3 font-semibold text-white transition hover:bg-[#B56F3C] sm:w-auto">

                Changer le mot de passe

            </button>

        </div>

    </form>

</div>

</div>
