<?php

use App\Enums\StatusAnimal;
use App\Models\Adoption;
use App\Models\Animal;
use Livewire\Component;

new class extends Component {

    public int $animalsInShelterCount;
    public int $adoptionsCount;
    public int $animalsWelcomedCount;

    public \Illuminate\Support\Carbon $currentMonth;


    public function mount(): void
    {
        $this->currentMonth = now()->startOfMonth();

        $this->loadStats();


    }

    public function previousMonth(): void
    {
        $this->currentMonth->subMonth();

        $this->loadStats();
    }

    public function nextMonth(): void
    {
        $this->currentMonth->addMonth();

        $this->loadStats();
    }

    public function loadStats(): void
    {
        $start = $this->currentMonth->copy()->startOfMonth();
        $end = $this->currentMonth->copy()->endOfMonth();


        $this->animalsInShelterCount = Animal::whereIn('status', [
            StatusAnimal::ADOPTABLE,
            StatusAnimal::PENDING,
        ])->count();

        $this->animalsWelcomedCount = Animal::whereBetween('created_at', [$start, $end])
            ->count();

        $this->adoptionsCount = Adoption::whereBetween('created_at', [$start, $end])
            ->count();
    }


    public function download(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $start = $this->currentMonth->copy()->startOfMonth();
        $end = $this->currentMonth->copy()->endOfMonth();

        $animals = Animal::whereBetween('created_at', [$start, $end])->get();

        $adoptions = Adoption::whereBetween('created_at', [$start, $end])->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.monthly-report', [
            'month' => $this->currentMonth,
            'animalsInShelterCount' => $this->animalsInShelterCount,
            'animalsWelcomedCount' => $this->animalsWelcomedCount,
            'adoptionsCount' => $this->adoptionsCount,
            'animals' => $animals,
            'adoptions' => $adoptions,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'rapport-' . $this->currentMonth->format('Y-m') . '.pdf'
        );
    }

};
?>

<div class="space-y-8">

    <div class="flex items-center justify-between">

        <div class="flex items-center gap-6">

            <button
                wire:click="previousMonth"
                class="cursor-pointer rounded-xl border p-2 hover:bg-gray-100"
            >
                ←
            </button>

            <h1 class="text-2xl font-bold">
                {{ ucfirst($currentMonth->translatedFormat('F Y')) }}
            </h1>

            <button
                wire:click="nextMonth"
                class="cursor-pointer rounded-xl border p-2 hover:bg-gray-100"
            >
                →
            </button>

        </div>

        <button
            type="button"
            wire:click="download"
            class="rounded-2xl bg-[#C67C47] px-6 py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]"
        >
            Télécharger le rapport PDF
        </button>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-gray-500">
                Animaux encore au refuge
            </p>

            <h2 class="mt-3 text-5xl font-bold">
                {{ $animalsInShelterCount }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Animaux présents actuellement
            </p>

        </div>


        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-gray-500">
                Demandes d'adoption
            </p>

            <h2 class="mt-3 text-5xl font-bold">
                {{ $adoptionsCount }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Reçues durant le mois
            </p>

        </div>


        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-gray-500">
                Animaux accueillis
            </p>

            <h2 class="mt-3 text-5xl font-bold">
                {{ $animalsWelcomedCount }}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Accueillis durant le mois
            </p>

        </div>

    </div>


    <div class="rounded-3xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 p-6">

            <h2 class="text-xl font-semibold">
                Demandes d'adoption
            </h2>
        </div>

        <div class="p-6">

            <livewire:livewire.adoption.adoption-list
                :month="$currentMonth"
            />

        </div>

    </div>

</div>
