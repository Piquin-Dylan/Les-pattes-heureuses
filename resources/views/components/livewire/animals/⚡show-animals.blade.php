<?php

use App\Enums\StatusAnimal;
use App\Models\Animal;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $searchAnimal = '';

    public string $filters = 'toutes';

    public string $filtersStatus = 'tous';

    public bool $pendingOnly = false;

    public function filter($string): void
    {
        $this->filters = $string;
    }

    public function updatedPendingOnly(): void
    {
        if ($this->pendingOnly) {
            $this->filtersStatus = StatusAnimal::PENDING->value;
        } else {
            $this->filtersStatus = 'tous';
        }

        $this->resetPage();
    }

    public function getPendingCountProperty(): int
    {
        return Animal::where('status', StatusAnimal::PENDING->value)->count();
    }

    public function getAnimalsProperty()
    {
        return Animal::query()
            ->when(Gate::denies('manage-animals'), function ($query) {
                $query->where('status', StatusAnimal::ADOPTABLE->value);
            })
            ->when($this->searchAnimal, function ($query) {
                $query->where('name', 'like', '%' . $this->searchAnimal . '%');
            })
            ->when($this->filters !== 'toutes', function ($query) {
                $query->where('species', $this->filters);
            })
            ->when(
                Gate::allows('manage-animals') && $this->filtersStatus !== 'tous',
                function ($query) {
                    $query->where('status', $this->filtersStatus);
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

        <x-search
            search="searchAnimal"
            filter="filters"
            status="filtersStatus"
            pendingOnly="pendingOnly"
            :pendingCount="$this->pendingCount"
            :enum="\App\Enums\StatusAnimal::class"
        />

    </div>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

        @foreach($this->animals as $animal)
            <x-card-animal :animal="$animal"/>
        @endforeach

    </div>

</div>
