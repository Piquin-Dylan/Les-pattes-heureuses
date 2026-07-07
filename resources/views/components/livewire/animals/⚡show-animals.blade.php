<?php

use App\Models\Animal;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $searchAnimal = '';

    public string $filters = 'toutes';

    public string $filtersStatus = 'tous';

    public function filter($string): void
    {
        $this->filters = $string;
    }

    public function getAnimalsProperty()
    {
        return Animal::query()
            ->when(Gate::denies('manage-animals'), function ($query) {
                $query->where('status', 'Adoptable');
            })
            ->when($this->searchAnimal, function ($query) {
                $query->where(
                    'name',
                    'like',
                    '%' . $this->searchAnimal . '%'
                );
            })
            ->when($this->filters !== 'toutes', function ($query) {
                $query->where(
                    'animals.species',
                    $this->filters
                );
            })
            ->when(
                Gate::allows('manage-animals') && $this->filtersStatus !== 'tous',
                function ($query) {
                    $query->where(
                        'animals.status',
                        $this->filtersStatus
                    );
                }
            )
            ->paginate(6);
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

        @can('manage-animals')
            <a
                href="{{ route('animals.create') }}"
                class="rounded-2xl bg-[#C67C47] px-6 py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">
                Ajouter un animal
            </a>
        @endcan

    </div>

    {{ $this->animals->links() }}

    <div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="grid gap-4 lg:grid-cols-4">

            <div class="lg:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Recherche
                </label>

                <input
                    wire:model.live.debounce.300ms="searchAnimal"
                    type="text"
                    placeholder="Nom d'un animal..."
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#C67C47]">

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Espèce
                </label>

                <select
                    wire:model.live="filters"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3">

                    <option value="toutes">toutes</option>
                    <option value="chat">chat</option>
                    <option value="chien">chien</option>

                </select>

            </div>

            @can('manage-animals')
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Statut
                    </label>

                    <select
                        wire:model.live="filtersStatus"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3">

                        <option value="tous">tous</option>

                        @foreach(\App\Enums\StatusAnimal::cases() as $status)
                            <option value="{{ $status->value }}">
                                {{ $status->label() }}
                            </option>
                        @endforeach

                    </select>

                </div>
            @endcan

        </div>

    </div>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

        @foreach($this->animals as $animal)
            <x-card-animal :animal="$animal"></x-card-animal>
        @endforeach

    </div>

</div>
