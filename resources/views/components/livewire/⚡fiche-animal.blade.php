<?php

use App\Models\Animal;
use Livewire\Component;

new class extends Component {
    public Animal $animal;

}
?>

<div class="mx-auto max-w-6xl space-y-6">

    <a
        href="{{ route('animals') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-[#C67C47] hover:underline">

        ← Retour aux animaux

    </a>

    <div class="overflow-hidden rounded-3xl bg-white shadow-md">

        <div class="flex justify-center items-center mt-8">
        <div class="w-32 aspect-square overflow-hidden rounded-full">
            <img
                src="{{ asset('storage/animals/'.$animal->photo.'/640.webp') }}"
                srcset="
            {{ asset('storage/animals/'.$animal->photo.'/320.webp') }} 320w,
            {{ asset('storage/animals/'.$animal->photo.'/640.webp') }} 640w,
            {{ asset('storage/animals/'.$animal->photo.'/1280.webp') }} 1280w"
                sizes="128px"
                alt="{{ $animal->name }}"
                class="w-full h-full object-cover">
        </div>
        </div>
        <div class="space-y-6 p-6">

            <div>

                <span class="rounded-full bg-[#C67C47] px-4 py-2 text-sm font-semibold text-white">

                    {{ ucfirst($animal->status) }}

                </span>

                <h1 class="mt-4 text-3xl font-bold">

                    {{ $animal->name }}

                </h1>

            </div>

            <div class="rounded-2xl border border-gray-200 p-5">

                <h2 class="mb-5 text-lg font-bold">

                    Informations

                </h2>

                <div class="grid grid-cols-2 gap-y-5">

                    <div>

                        <p class="text-sm text-gray-500">
                            Espèce
                        </p>

                        <p class="font-semibold">

                            {{ ucfirst($animal->species) }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Sexe
                        </p>

                        <p class="font-semibold">

                            {{ ucfirst($animal->sex) }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Race
                        </p>

                        <p class="font-semibold">

                            {{--
                                                        {{ $animal->breed->name }}
                            --}}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Naissance
                        </p>

                        <p class="font-semibold">

                            {{ $animal->age }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Pellage
                        </p>

                        <p class="font-semibold">

                            {{ ucfirst(str_replace('_',' ',$animal->coat)) }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Vaccin
                        </p>

                        <p class="font-semibold">

                            {{--
                                                        {{ $animal->vaccine->name }}
                            --}}

                        </p>

                    </div>

                </div>

            </div>

            <div class="rounded-2xl border border-gray-200 p-5">

                <h2 class="mb-4 text-lg font-bold">

                    Description

                </h2>

                <p class="leading-7 text-gray-600">

                    {{ $animal->description }}

                </p>

            </div>

            <div class="flex flex-col gap-3">

                <button
                    class="rounded-2xl bg-[#C67C47] py-4 font-semibold text-white transition hover:bg-[#B56F3C]">

                    Modifier l'animal

                </button>

                <button
                    class="rounded-2xl border border-red-500 py-4 font-semibold text-red-500 transition hover:bg-red-50">

                    Supprimer

                </button>

            </div>

        </div>

    </div>

</div>
