<?php

use App\Enums\StatusAnimal;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

new class extends Component {

    public int $animalsInShelterCount;
    public int $adoptionsCount;
    public int $animalsWelcomedCount;
    public Collection $awaitingNotificationAdoptions;

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

        $this->awaitingNotificationAdoptions = Adoption::with('animal')
            ->awaitingNotification()
            ->latest()
            ->get();
    }


    public function download(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $start = $this->currentMonth->copy()->startOfMonth();
        $end = $this->currentMonth->copy()->endOfMonth();

        $animals = Animal::with('breed')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $adoptions = Adoption::with('animal')
            ->whereBetween('created_at', [$start, $end])
            ->get();

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

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div class="flex items-center gap-3 sm:gap-6">

            <button
                wire:click="previousMonth"
                class="cursor-pointer rounded-xl border p-2 hover:bg-gray-100"
            >
                ←
            </button>

            <h1 class="text-xl font-bold sm:text-2xl">
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
            class="w-full rounded-2xl bg-[#C67C47] px-6 py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c] sm:w-auto"
        >
            Télécharger le rapport PDF
        </button>

    </div>


    @if($awaitingNotificationAdoptions->isNotEmpty())

        <div class="rounded-3xl border border-amber-200 bg-amber-50 p-6">

            <div class="flex items-start gap-3">

                <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </span>

                <div>
                    <h2 class="text-lg font-semibold text-amber-900">
                        Tâches à finaliser
                    </h2>
                    <p class="mt-1 text-sm text-amber-800">
                        Ces demandes sont passées « en cours » mais le demandeur n’a pas encore été notifié par e-mail.
                    </p>
                </div>

            </div>

            <ul class="mt-4 space-y-2">
                @foreach($awaitingNotificationAdoptions as $awaitingAdoption)
                    <li class="flex flex-col gap-2 rounded-xl bg-white px-4 py-3 text-sm sm:flex-row sm:items-center sm:justify-between">
                        <span class="text-[#202534]">
                            <strong>{{ $awaitingAdoption->firstName }} {{ $awaitingAdoption->lastName }}</strong>
                            — demande pour {{ $awaitingAdoption->animal->name }}
                        </span>
                        <a
                            href="{{ route('adoption.fiche', $awaitingAdoption) }}"
                            class="font-semibold text-[#C67C47] hover:underline">
                            Traiter la demande →
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

    @endif

    <div class="grid gap-6 lg:grid-cols-3">

        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-gray-500">
                Animaux encore au refuge
            </p>

            <h2 class="mt-3 text-4xl font-bold sm:text-5xl">
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

            <h2 class="mt-3 text-4xl font-bold sm:text-5xl">
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

            <h2 class="mt-3 text-4xl font-bold sm:text-5xl">
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
                :show-header="false"/>
        </div>

    </div>

</div>
