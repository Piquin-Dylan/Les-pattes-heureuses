<?php

use App\Models\Animal;
use Livewire\Component;

new class extends Component {

    public $animals;

    public function mount()
    {
        $this->animals = Animal::all();
    }
};
?>

<div class="space-y-8">

    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Tous les animaux
            </h1>

            <p class="mt-1 text-gray-500">
                Retrouvez tous les animaux disponibles à l'adoption.
            </p>
        </div>

        <a
            href="{{ route('animals.create') }}"
            class="rounded-2xl bg-[#C67C47] px-6 py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">

            Ajouter un animal

        </a>

    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="grid gap-4 lg:grid-cols-4">

            <div class="lg:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Recherche
                </label>

                <input
                    type="text"
                    placeholder="Nom d'un animal..."
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#C67C47]">

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Espèce
                </label>

                <select class="w-full rounded-xl border border-gray-300 px-4 py-3">

                    <option>Toutes</option>
                    <option>Chien</option>
                    <option>Chat</option>

                </select>

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Statut
                </label>

                <select class="w-full rounded-xl border border-gray-300 px-4 py-3">

                    <option>Tous</option>
                    <option>Adoptable</option>
                    <option>Adopté</option>
                    <option>En soin</option>

                </select>

            </div>

        </div>

    </div>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

        @foreach($this->animals as $animal)

            <div
                class="group overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                <div class="relative">

                    <img
                        src="{{asset($animal->photo)}}"
                        alt=""
                        class="aspect-square w-full object-cover">

                    <span
                        class="absolute left-4 top-4 rounded-full bg-[#C67C47] px-3 py-1 text-xs font-semibold text-white">

                        {{ $animal->status }}

                    </span>
                </div>
                <div class="space-y-4 p-5">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">

                            {{ $animal->name }}
                        </h2>
                        <p class="text-sm text-gray-500">

                            {{ $animal->breed?->name }}
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">

                        <div>

                            <p class="text-gray-400">
                                Espèce
                            </p>

                            <p class="font-medium">

                                {{ ucfirst($animal->species) }}

                            </p>

                        </div>
                        <div>

                            <p class="text-gray-400">
                                Sexe
                            </p>

                            <p class="font-medium">

                                {{ ucfirst($animal->sex) }}

                            </p>

                        </div>
                    </div>
                    <a
                        href="#"
                        class="block rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">
                        Voir la fiche
                    </a>

                </div>
            </div>

        @endforeach

    </div>

</div>
