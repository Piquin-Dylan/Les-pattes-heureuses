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
    <x-fiche_animal :animal="$animal"></x-fiche_animal>

    @unless(Auth::guest())
        <div class="flex flex-col gap-3">

            <a href="{{route('animals.edit',$animal->id)}}"
               class="rounded-2xl bg-[#C67C47] py-4 font-semibold text-white transition hover:bg-[#B56F3C]">

                Modifier l'animal
            </a>

            @can('is-admin')

            <button wire:click="deleteAnimal"
                    class="rounded-2xl border border-red-500 py-4 font-semibold text-red-500 transition hover:bg-red-50">

                Supprimer
            </button>
            @endcan


        </div>
    @endunless
    @guest
        <a
            href="{{ route('public.adoption', ['animal' => $animal->name]) }}"
            class="block rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">
            Demande d'adoption
        </a>
        <x-share_animal :animal="$animal"/>
    @endguest


    <x-update_status
        :enum="\App\Enums\StatusAnimal::class"
        model="requestAdoption"
        action="updateStatusAdoption"/>
</div>
