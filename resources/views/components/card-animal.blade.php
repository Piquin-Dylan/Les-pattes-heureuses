<article
    itemscope itemtype="https://schema.org/Product"
    class="group overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

    <div class="relative">

        @if($animal->photo)
            <img
                src="{{ asset('storage/animals/'.$animal->photo.'/640.webp') }}"
                srcset="
                    {{ asset('storage/animals/'.$animal->photo.'/320.webp') }} 320w,
                    {{ asset('storage/animals/'.$animal->photo.'/640.webp') }} 640w,
                    {{ asset('storage/animals/'.$animal->photo.'/1024.webp') }} 1024w,
                    {{ asset('storage/animals/'.$animal->photo.'/1600.webp') }} 1600w"
                sizes="(min-width: 1280px) 25vw, (min-width: 640px) 50vw, 100vw"
                alt="{{ $animal->name }}"
                itemprop="image"
                loading="lazy"
                decoding="async"
                class="aspect-square w-full object-cover">
        @else
            <div class="flex aspect-square w-full items-center justify-center bg-[#FBF4EC]">
                <span class="text-6xl" aria-hidden="true">🐾</span>
            </div>
        @endif

        <span
            class="absolute left-4 top-4 rounded-full bg-[#C67C47] px-3 py-1 text-xs font-semibold text-white">

                        {{ $animal->status }}

                    </span>
    </div>
    <div class="space-y-4 p-5">
        <div>
            <h3 class="text-xl font-bold text-gray-900" itemprop="name">

                {{ $animal->name }}
            </h3>
            <p class="text-sm text-gray-500">

                {{ $animal->breed?->name }}
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4 text-sm">

            <div>

                <p class="text-gray-400">
                    Espèce
                </p>

                <p class="font-medium" itemprop="category">

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
        ? route('animals.show', $animal)
        : route('public.animals.show', $animal)
    }}"
            class="block rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]"
        >
            Voir la fiche
        </a>

    </div>
</article>
