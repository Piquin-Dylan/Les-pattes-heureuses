<?php

use App\Enums\AdoptionStatus;
use App\Models\Adoption;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $searchAnimal = '';

    public string $filters = 'toutes';

    public string $filtersStatus = 'tous';

    public bool $pendingOnly = false;

    public bool $showHeader = true;

    public function updatedPendingOnly(): void
    {
        if ($this->pendingOnly) {
            $this->filtersStatus = AdoptionStatus::Pending->value;
        } else {
            $this->filtersStatus = 'tous';
        }

        $this->resetPage();
    }

    public function getPendingCountProperty(): int
    {
        return Adoption::where('status', AdoptionStatus::Pending->value)->count();
    }

    public function getAdoptionsProperty()
    {
        return Adoption::query()
            ->with('animal')
            ->latest()
            ->when($this->searchAnimal, function ($query) {
                $query->where('firstName', 'like', '%' . $this->searchAnimal . '%')
                    ->orWhereHas('animal', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchAnimal . '%');
                    });
            })->when($this->filtersStatus !== 'tous',
                function ($query) {
                    $query->where(
                        'adoptions.status',
                        $this->filtersStatus
                    );
                }
            )
            ->paginate(10);
    }
};
?>

<div class="space-y-6">

    @if($showHeader)
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <x-page-header
                title="Demandes d'adoption"
                description="Suivez et gérez les demandes d'adoption."/>

            @can('manage-animals')
                <a
                    href="{{ route('adoptions.create') }}"
                    class="rounded-2xl bg-[#C67C47] px-6 py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">
                    Nouvelle adoption
                </a>
            @endcan

        </div>
    @endif

    <x-search
        search="searchAnimal"
        filter="filters"
        status="filtersStatus"
        pendingOnly="pendingOnly"
        :pendingCount="$this->pendingCount"
        :enum="\App\Enums\AdoptionStatus::class"
    />

    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">

                <thead class="bg-gray-50">
                <tr class="text-left text-sm text-gray-500">
                    <th class="px-3 py-3 sm:px-6 sm:py-4 font-medium">Demandeur</th>
                    <th class="px-3 py-3 sm:px-6 sm:py-4 font-medium">Animal</th>
                    <th class="px-3 py-3 sm:px-6 sm:py-4 font-medium">Date</th>
                    <th class="px-3 py-3 sm:px-6 sm:py-4 font-medium">Statut</th>
                    <th class="px-3 py-3 sm:px-6 sm:py-4 font-medium">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                @foreach($this->adoptions as $adoption)
                    <tr class="transition hover:bg-gray-50">

                        <td class="px-3 py-3 sm:px-6 sm:py-4">
                                <span class="font-semibold text-gray-900">
                                    {{ $adoption->firstName }}
                                </span>
                        </td>

                        <td class="px-3 py-3 sm:px-6 sm:py-4 text-gray-700">
                            <a
                                href="{{ route('animals.show', $adoption->animal) }}"
                                class="font-medium text-[#C67C47] hover:underline">
                                {{ $adoption->animal->name }}
                            </a>
                        </td>

                        <td class="px-3 py-3 sm:px-6 sm:py-4 text-gray-500">
                            {{ $adoption->created_at->format('d/m/Y') }}
                        </td>

                        <td class="px-3 py-3 sm:px-6 sm:py-4">
                                <span class="rounded-full bg-[#C67C47]/10 px-3 py-1 text-sm font-semibold text-[#C67C47]">
                                    {{ $adoption->status }}
                                </span>
                        </td>

                        <td class="px-3 py-3 sm:px-6 sm:py-4">
                            <a
                                href="{{ route('adoption.fiche', $adoption->id)}}"
                                class="font-semibold text-[#C67C47] hover:underline">
                                Voir la demande
                            </a>
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>

    </div>

    {{ $this->adoptions->links('components.custom') }}

</div>
