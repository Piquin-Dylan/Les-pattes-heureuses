<?php

use App\Enums\DayOfWeek;
use App\Livewire\Form\CreateMembershipRequest;
use Livewire\Component;

new class extends Component {

    public CreateMembershipRequest $form;

    public function save(): void
    {
        $this->form->validate();
        $this->form->submit();

        $this->form->reset();

        $this->dispatch('toast', message: 'Votre demande pour devenir membre a bien été envoyée ! Nous reviendrons vers vous rapidement.', type: 'success');
    }

    public function days(): array
    {
        return DayOfWeek::cases();
    }

};
?>

<div>

    <section class="bg-[#FDF8F4] px-8 py-16">
        <div class="mx-auto max-w-5xl text-center">
            <p class="text-xs font-semibold uppercase tracking-wider text-[#C67C47]">
                Rejoignez l'aventure
            </p>
            <h1 class="mt-3 text-4xl font-bold text-gray-900 sm:text-5xl">
                Devenir membre
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-gray-600">
                Les Pattes Heureuses fonctionne grâce à l'engagement de ses membres. En nous
                rejoignant, vous aidez directement les animaux du refuge : promenades,
                socialisation, entretien, événements et bien plus encore.
            </p>
        </div>
    </section>

    <section class="px-8 py-16">
        <div class="mx-auto max-w-6xl">

            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                    Pourquoi devenir membre ?
                </h2>
                <p class="mt-2 text-gray-500">
                    Chaque bonne volonté compte, quel que soit le temps que vous pouvez y consacrer.
                </p>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FDF8F4] text-[#C67C47]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.97-3.2-9-6.8-9-11a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 4.2-4.03 7.8-9 11Z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">
                        Aidez les animaux au quotidien
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Promenades, câlins, socialisation... votre présence apporte
                        du réconfort aux pensionnaires du refuge.
                    </p>
                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FDF8F4] text-[#C67C47]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 0 0-3-3.87M9 20H4v-1a4 4 0 0 1 3-3.87m5-8.13a4 4 0 1 1 0 8 4 4 0 0 1 0-8Zm6 4a4 4 0 1 0-3-6.65M6.5 8.35A4 4 0 1 0 9 2"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">
                        Rejoignez une communauté engagée
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Intégrez une équipe de bénévoles passionnés et participez
                        aux événements organisés par le refuge.
                    </p>
                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FDF8F4] text-[#C67C47]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">
                        Selon vos disponibilités
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Une heure par semaine ou plusieurs jours, indiquez-nous
                        vos disponibilités et nous nous adaptons.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <section class="bg-[#FDF8F4] px-8 py-16">
        <div class="mx-auto max-w-4xl">

            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                    Comment ça marche ?
                </h2>
            </div>

            <div class="mt-10 grid gap-8 sm:grid-cols-3">

                <div class="text-center">
                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#C67C47] text-base font-bold text-white">
                        1
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">
                        Vous remplissez le formulaire
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Renseignez vos coordonnées et vos disponibilités ci-dessous.
                    </p>
                </div>

                <div class="text-center">
                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#C67C47] text-base font-bold text-white">
                        2
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">
                        Nous étudions votre demande
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Notre équipe prend connaissance de votre demande et vous recontacte.
                    </p>
                </div>

                <div class="text-center">
                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-[#C67C47] text-base font-bold text-white">
                        3
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">
                        Vous rejoignez le refuge
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Nous organisons ensemble votre arrivée parmi nos membres.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <section class="px-8 py-16">
        <div class="mx-auto max-w-3xl">

            <form
                wire:submit.prevent="save"
                class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8"
            >

                <div class="mb-8">
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#C67C47]">
                        Formulaire d'inscription
                    </p>
                    <h2 class="mt-2 text-2xl font-bold text-gray-900">
                        Faire une demande pour devenir membre
                    </h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Complétez ce formulaire, notre équipe reviendra vers vous dans les
                        meilleurs délais.
                    </p>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">

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
                    <label class="mb-3 block text-sm font-semibold text-gray-700">
                        Vos disponibilités
                    </label>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                        @foreach ($this->days() as $day)
                            <label
                                for="availability-{{ $day->value }}"
                                class="flex cursor-pointer items-center gap-2 rounded-2xl border border-[#E7D7C7] bg-white px-4 py-3 text-sm font-medium text-[#2F2F2F] transition-all duration-200 has-checked:border-[#C67C47] has-checked:bg-[#FDF8F4] has-checked:text-[#C67C47]"
                            >
                                <input
                                    type="checkbox"
                                    id="availability-{{ $day->value }}"
                                    value="{{ $day->value }}"
                                    wire:model.live="form.availabilities"
                                    class="h-4 w-4 rounded border-[#E7D7C7] text-[#C67C47] focus:ring-[#C67C47]"
                                >
                                {{ $day->label() }}
                            </label>
                        @endforeach
                    </div>

                    @error('form.availabilities')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label
                        for="message"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Un mot sur votre motivation (facultatif)
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        wire:model.live="form.message"
                        rows="5"
                        placeholder="Présentez-vous et dites-nous pourquoi vous souhaitez devenir membre..."
                        class="w-full resize-none rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#C67C47] focus:ring-4 focus:ring-[#C67C47]/10"
                    ></textarea>
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

                        <span wire:loading wire:target="save">
                            Envoi en cours...
                        </span>

                    </button>

                </div>

            </form>

        </div>
    </section>

</div>
