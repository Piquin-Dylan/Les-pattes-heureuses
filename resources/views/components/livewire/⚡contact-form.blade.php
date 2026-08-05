<?php

use App\Livewire\Form\ContactForm;
use Livewire\Component;

new class extends Component {

    public ContactForm $form;

    public function save(): void
    {
        $this->form->validate();
        $this->form->submit();

        $this->form->reset();

        $this->dispatch('toast', message: 'Votre message a bien été envoyé !', type: 'success');
    }
};
?>

<div>
    <div class="px-8 py-20">
        <div class="mx-auto max-w-7xl">

        <section class="mb-8">
            <x-page-header
                title="Nous contacter"
                description="Une question ? Envoyez-nous un message, nous vous répondrons dès que possible."
            />
        </section>

        <div class="grid gap-8 lg:grid-cols-3">

            <form
                wire:submit.prevent="save"
                class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">

                <h2 class="text-xl font-semibold text-gray-800">
                    Vos informations
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Merci de remplir l'ensemble des champs afin que nous puissions vous répondre au mieux.
                </p>

                <div class="mt-6 grid gap-5 sm:grid-cols-2">

                    <x-form.input
                        label_name="Nom"
                        for_label="lastName"
                        type="text"
                        id="lastName"
                        name="lastName"
                        wire:model.live="form.lastName"
                    />

                    <x-form.input
                        label_name="Prénom"
                        for_label="firstName"
                        type="text"
                        id="firstName"
                        name="firstName"
                        wire:model.live="form.firstName"
                    />

                    <x-form.input
                        label_name="Adresse mail"
                        for_label="email"
                        type="email"
                        id="email"
                        name="email"
                        wire:model.live="form.email"
                    />

                    <x-form.input
                        label_name="Numéro de téléphone"
                        for_label="phone"
                        type="tel"
                        id="phone"
                        name="phone"
                        wire:model.live="form.phone"
                    />

                    <div class="sm:col-span-2">
                        <x-form.input
                            label_name="Objet"
                            for_label="object"
                            type="text"
                            id="object"
                            name="object"
                            wire:model.live="form.object"
                        />
                    </div>

                </div>

                <div class="mt-6">

                    <label
                        for="message"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Message
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="7"
                        wire:model.live="form.message"
                        class="w-full resize-none rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-800 outline-none transition focus:border-[#C67C47] focus:ring-2 focus:ring-[#C67C47]/20"
                        placeholder="Écrivez votre message..."
                    ></textarea>

                    @error('form.message')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div class="mt-8 flex justify-end border-t border-gray-100 pt-6">

                    <button
                        type="submit"
                        class="w-full cursor-pointer rounded-2xl bg-[#C67C47] px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-[#b56f3c] active:scale-95 lg:w-auto"
                    >
                        Envoyer le message
                    </button>

                </div>

            </form>

            <x-contact_informations></x-contact_informations>

        </div>
          <x-toast></x-toast>
        </div>
    </div>
</div>
