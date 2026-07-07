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



<div class="w-full px-4 py-6 sm:px-6 lg:px-8">

    <section class="mx-auto max-w-6xl">

        <x-page-header
            title="Demande d'adoption"
            description="Remplissez ce formulaire pour nous faire part de votre intérêt pour {{ $animal->name }}."
        />

        <div class="mt-8 grid gap-6 lg:grid-cols-[320px_1fr] lg:items-start">

            <aside
                class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm lg:sticky lg:top-6"
            >

                <div class="aspect-[4/3] w-full overflow-hidden bg-[#F7F2ED]">

                    @if($animal->photo)
                        <img
                            src="{{ asset('storage/' . $animal->photo) }}"
                            alt="Photo de {{ $animal->name }}"
                            class="h-full w-full object-cover"
                        >
                    @else
                        <div class="flex h-full items-center justify-center">
                            <svg
                                class="h-16 w-16 text-[#C67C47]/40"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.5 9.5c-1.2 0-2.2-1.1-2.2-2.5s1-2.5 2.2-2.5S8.7 5.6 8.7 7s-1 2.5-2.2 2.5Zm11 0c-1.2 0-2.2-1.1-2.2-2.5s1-2.5 2.2-2.5 2.2 1.1 2.2 2.5-1 2.5-2.2 2.5ZM9.2 7.2C8 7.2 7 6 7 4.6S8 2 9.2 2s2.2 1.2 2.2 2.6-1 2.6-2.2 2.6Zm5.6 0c-1.2 0-2.2-1.2-2.2-2.6S13.6 2 14.8 2 17 3.2 17 4.6s-1 2.6-2.2 2.6ZM12 9.2c-3.4 0-6.3 2.8-6.3 6.1 0 2.7 2 4.7 4.4 4.7.8 0 1.4-.3 1.9-.7.5.4 1.1.7 1.9.7 2.4 0 4.4-2 4.4-4.7 0-3.3-2.9-6.1-6.3-6.1Z"
                                />
                            </svg>
                        </div>
                    @endif

                </div>

                <div class="p-5 sm:p-6">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-[#C67C47]">
                                Votre demande concerne
                            </p>

                            <h2 class="mt-1 text-2xl font-bold text-gray-900">
                                {{ $animal->name }}
                            </h2>
                        </div>

                        <span
                            class="shrink-0 rounded-full bg-[#F7F2ED] px-3 py-1 text-xs font-semibold text-[#A45F32]"
                        >
                            {{ $animal->status->value ?? $animal->status }}
                        </span>

                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">

                        <div class="rounded-2xl bg-gray-50 p-3">
                            <p class="text-xs text-gray-500">
                                Espèce
                            </p>

                            <p class="mt-1 font-semibold capitalize text-gray-800">
                                {{ $animal->species->value ?? $animal->species }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-3">
                            <p class="text-xs text-gray-500">
                                Sexe
                            </p>

                            <p class="mt-1 font-semibold capitalize text-gray-800">
                                {{ $animal->sex->value ?? $animal->sex }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-3">
                            <p class="text-xs text-gray-500">
                                Race
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ $animal->breed?->name ?? 'Non renseignée' }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-3">
                            <p class="text-xs text-gray-500">
                                Âge
                            </p>

                            <p class="mt-1 font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($animal->age)->age }} ans
                            </p>
                        </div>

                    </div>

                    @if($animal->description)
                        <div class="mt-6 border-t border-gray-100 pt-5">

                            <p class="text-sm leading-6 text-gray-600">
                                {{ $animal->description }}
                            </p>

                        </div>
                    @endif

                </div>

            </aside>

            <form
                wire:submit.prevent="save"
                class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6 lg:p-8"
            >

                <div class="mb-8">

                    <p class="text-xs font-semibold uppercase tracking-wider text-[#C67C47]">
                        Vos informations
                    </p>

                    <h2 class="mt-2 text-xl font-bold text-gray-900 sm:text-2xl">
                        Parlez-nous de vous
                    </h2>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                        Ces informations nous permettront de vous recontacter
                        concernant votre demande pour {{ $animal->name }}.
                    </p>

                </div>

                <div class="grid gap-5 md:grid-cols-2">

                    <x-form.input
                        label_name="Prénom"
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
                        label_name="Numéro de téléphone"
                        for_label="phone"
                        type="tel"
                        id="phone"
                        name="phone"
                        wire:model.live="form.phone"
                    />

                </div>

                <div class="mt-6">

                    <label
                        for="message"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Votre message
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        wire:model.live="form.message"
                        rows="6"
                        placeholder="Présentez-vous en quelques mots et expliquez-nous pourquoi vous souhaitez adopter {{ $animal->name }}..."
                        class="w-full resize-none rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#C67C47] focus:ring-4 focus:ring-[#C67C47]/10"
                    ></textarea>

                    @error('form.message')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div class="mt-6 rounded-2xl border border-[#C67C47]/20 bg-[#FDF8F4] p-4">

                    <div class="flex items-start gap-3">

                        <svg
                            class="mt-0.5 h-5 w-5 shrink-0 text-[#C67C47]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path stroke-linecap="round" d="M12 10v6"/>
                            <path stroke-linecap="round" d="M12 7h.01"/>
                        </svg>

                        <p class="text-sm leading-6 text-gray-600">
                            L'envoi de ce formulaire ne garantit pas automatiquement
                            l'adoption. Notre équipe étudiera votre demande et vous
                            recontactera prochainement.
                        </p>

                    </div>

                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="save"
                        class="inline-flex w-full cursor-pointer items-center justify-center gap-2 rounded-2xl bg-[#C67C47] px-8 py-4 text-base font-semibold text-white shadow-lg shadow-[#C67C47]/20 transition hover:bg-[#b56f3c] active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto"
                    >

                        <span wire:loading.remove wire:target="save">
                            Envoyer ma demande
                        </span>

                        <span
                            wire:loading
                            wire:target="save"
                            class="items-center gap-2"
                        >
                            Envoi en cours...
                        </span>

                        <svg
                            wire:loading.remove
                            wire:target="save"
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 12h14M13 6l6 6-6 6"
                            />
                        </svg>

                    </button>

                </div>

            </form>

        </div>

    </section>

</div>
