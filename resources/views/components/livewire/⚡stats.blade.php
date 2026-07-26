<?php

use App\Enums\StatusAnimal;
use App\Models\Adoption;
use App\Models\Animal;
use Barryvdh\DomPDF\Facade\Pdf;
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

<div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

    <div class="flex items-center gap-4">
        <button wire:click="previousMonth">
            ←
        </button>

        <span class="font-bold">
            {{ ucfirst($currentMonth->translatedFormat('F Y')) }}
        </span>

        <button wire:click="nextMonth">
            →
        </button>
    </div>

    <button type="button" wire:click="download">Download</button>


    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Animaux encore au refuge
                </p>

                <h2 class="mt-2 text-4xl font-bold text-gray-900">
                    {{ $animalsInShelterCount }}
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Animaux actuellement présents au refuge
                </p>

            </div>

        </div>

    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Demandes d'adoption
                </p>

                <h2 class="mt-2 text-4xl font-bold text-gray-900">
                    {{ $adoptionsCount }}
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Demandes reçues ce mois-ci
                </p>

            </div>

        </div>

    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Animaux accueillis
                </p>

                <h2 class="mt-2 text-4xl font-bold text-gray-900">
                    {{ $animalsWelcomedCount }}
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Animaux accueillis ce mois-ci
                </p>

            </div>

        </div>

    </div>

    <livewire:livewire.adoption.adoption-list/>

</div>
