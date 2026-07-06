<div
    class="group overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

    <div class="relative">

        <img
            src="{{ asset('storage/animals/'.$animal->photo.'/640.webp') }}"
            alt="{{ $animal->name }}"
            class="aspect-square w-full object-cover">

        <span
            class="absolute left-4 top-4 rounded-full bg-[#C67C47] px-3 py-1 text-xs font-semibold text-white">

                        {{ $animal->status }}

                    </span>
    </div>
    <div class="space-y-4 p-5">
        <div>
            <h2 class="text-xl font-bold text-gray-900">

                {{ $animal->name }}
            </h2>
            <p class="text-sm text-gray-500">

                {{ $animal->breed?->name }}
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4 text-sm">

            <div>

                <p class="text-gray-400">
                    Espèce
                </p>

                <p class="font-medium">

                    {{ ucfirst($animal->species) }}

                </p>

            </div>
            <div>

                <p class="text-gray-400">
                    Sexe
                </p>

                <p class="font-medium">

                    {{ ucfirst($animal->sex) }}

                </p>

            </div>
        </div>
        <a
            href="{{ auth()->check()
        ? route('animals.show', $animal->id)
        : route('public.animals.show', $animal->id)
    }}"
            class="block rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">

            Voir la fiche
        </a>

    </div>
</div>
