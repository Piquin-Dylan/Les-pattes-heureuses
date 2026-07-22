<?php

use App\Models\Animal;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

new class extends Component {
    public Animal $animal;

    public $requestAdoption;


    public function mount()
    {
        $this->requestAdoption = $this->animal->status;
    }

    public function deleteAnimal(): \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        if ($this->animal->delete()) {
            return redirect(route('animals'));
        }
    }

    public function updateStatusAdoption(): void
    {

        $this->animal->update([
            'status' => $this->requestAdoption,
        ]);
    }
}
?>

<div class="mx-auto max-w-6xl space-y-6">

    <a
        href="{{ route('animals') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-[#C67C47] hover:underline">
        ← Retour aux animaux
    </a>
    @auth

        @can('is-admin')

            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        Administration
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Gérez cette fiche et sa publication sur le site.
                    </p>
                </div>

                @if($animal->status === 'En attente')

                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                        <div class="flex items-start gap-3">

                            <div class="text-2xl">
                                ⏳
                            </div>

                            <div>

                                <h3 class="font-semibold text-amber-900">
                                    Fiche en attente de validation
                                </h3>

                                <p class="mt-1 text-sm text-amber-700">
                                    Cette fiche a été créée par un bénévole.
                                    Elle ne sera visible sur le site public qu'après validation.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif

                <div class="space-y-2">

                    <label class="block text-sm font-medium text-gray-700">
                        Statut de l'animal
                    </label>

                    <x-update_status
                        :enum="\App\Enums\StatusAnimal::class"
                        model="requestAdoption"
                        action="updateStatusAdoption"/>

                </div>

                <div class="grid gap-3 sm:grid-cols-2">

                    <a
                        href="{{ route('animals.edit', $animal) }}"
                        class="rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#B56F3C]">

                        Modifier la fiche

                    </a>

                    <button
                        wire:click="deleteAnimal"
                        wire:confirm="Êtes-vous sûr de vouloir supprimer cet animal ?"
                        class="rounded-xl border border-red-500 py-3 font-semibold text-red-500 transition hover:bg-red-50">

                        Supprimer

                    </button>

                </div>

            </div>

        @else

            <div class="flex flex-col gap-3">

                <a
                    href="{{ route('animals.edit', $animal) }}"
                    class="rounded-2xl bg-[#C67C47] py-4 text-center font-semibold text-white transition hover:bg-[#B56F3C]">

                    Modifier la fiche

                </a>

            </div>

        @endcan

    @endauth

    <x-fiche_animal :animal="$animal"/>

    @guest
        <div class="space-y-3">

            <a
                href="{{ route('public.adoption', ['animal' => $animal->name]) }}"
                class="block rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">

                Demande d'adoption

            </a>

            <x-share_animal :animal="$animal"/>

        </div>
    @endguest


</div>
