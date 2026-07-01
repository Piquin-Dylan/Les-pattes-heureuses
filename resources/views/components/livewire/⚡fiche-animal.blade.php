<?php

use App\Models\Animal;
use Livewire\Component;

new class extends Component {
    public Animal $animal;





    public function deleteAnimal(): \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        if ($this->animal->delete()) {
            return redirect(route('animals'));
        }
    }
}
?>

<div class="mx-auto max-w-6xl space-y-6">

    <a
            href="{{ route('animals') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-[#C67C47] hover:underline">

        ← Retour aux animaux

    </a>
    <x-fiche_animal :animal="$animal"></x-fiche_animal>

    <div class="flex flex-col gap-3">

        <button
            class="rounded-2xl bg-[#C67C47] py-4 font-semibold text-white transition hover:bg-[#B56F3C]">

            Modifier l'animal

        </button>

        <button wire:click="deleteAnimal"
                class="rounded-2xl border border-red-500 py-4 font-semibold text-red-500 transition hover:bg-red-50">

            Supprimer
        </button>

    </div>
</div>
