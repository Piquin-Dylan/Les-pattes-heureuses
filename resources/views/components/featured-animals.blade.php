@props([
    'animaux',
])

<section class="px-8 py-20">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Nos animaux à l'adoption</h2>
                <p class="mt-2 text-gray-500">Découvrez les compagnons qui n'attendent plus que vous.</p>
            </div>
            <a href="{{ route('animal') }}" class="font-semibold text-[#C67C47] hover:underline">
                Voir tous les animaux &rarr;
            </a>
        </div>

        @if($animaux->isEmpty())
            <p class="mt-10 text-gray-500">Aucun animal disponible pour le moment, revenez bientôt !</p>
        @else
            <div class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @foreach($animaux as $animal)
                    <x-card-animal :animal="$animal"/>
                @endforeach
            </div>
        @endif
    </div>
</section>
