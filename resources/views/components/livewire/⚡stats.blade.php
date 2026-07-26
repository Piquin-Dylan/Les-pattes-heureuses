<?php

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use Livewire\Component;

new class extends Component {

    public int $animalsCount;
    public int $adoptionsCount;
    public int $membersCount;

    public \Illuminate\Support\Carbon $currentMonth;


    public function mount(): void
    {
        $this->animalsCount = Animal::count();
        $this->adoptionsCount = Adoption::count();
        $this->membersCount = User::where('status', 'volontaire')->count();

        $this->currentMonth = now()->startOfMonth();
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

        $this->adoptions = Adoption::whereBetween('created_at', [$start, $end])->count();
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

    <p>{{ $adoptions }}</p>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Animaux
                </p>

                <h2 class="mt-2 text-4xl font-bold text-gray-900">
                    {{ $animalsCount }}
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Animaux enregistrés
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
                    Demandes reçues
                </p>

            </div>


        </div>

    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Membres
                </p>

                <h2 class="mt-2 text-4xl font-bold text-gray-900">
                    {{ $membersCount }}
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Membres du refuge
                </p>

            </div>
        </div>

    </div>

    <livewire:livewire.adoption.adoption-list></livewire:livewire.adoption.adoption-list>

</div>
