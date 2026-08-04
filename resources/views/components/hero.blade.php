@props([
    'adoptables' => 0,
    'adoptes' => 0,
])

<section class="relative overflow-hidden bg-[#FBF4EC] px-8 py-20">
    <div class="pointer-events-none absolute -top-24 -right-24 h-96 w-96 rounded-full bg-[#C67C47]/10 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-32 -left-24 h-96 w-96 rounded-full bg-[#BC8451]/10 blur-3xl"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-2">
        <div>
            <span class="inline-block rounded-full bg-[#C67C47]/10 px-4 py-1.5 text-sm font-semibold text-[#C67C47]">
                🐾 Refuge animalier
            </span>

            <h1 class="mt-6 text-4xl font-bold text-gray-900 sm:text-5xl lg:text-6xl">
                Les <span class="text-[#C67C47]">pattes heureuses</span>
            </h1>

            <p class="mt-6 max-w-xl text-lg text-gray-600">
                Nous prenons soin de chiens, chats et autres compagnons en attente d'un foyer,
                et les accompagnons pas à pas vers une nouvelle vie entourée d'amour.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('animal') }}"
                   class="rounded-xl bg-[#C67C47] px-8 py-3 font-semibold text-white shadow-md transition hover:bg-[#b56f3c]">
                    Voir nos animaux
                </a>
                <a href="{{ route('public.contact') }}"
                   class="rounded-xl border-2 border-[#C67C47] px-8 py-3 font-semibold text-[#C67C47] transition hover:bg-[#C67C47]/10">
                    Nous contacter
                </a>
            </div>

            <div class="mt-10 flex gap-10">
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $adoptables }}</p>
                    <p class="text-sm text-gray-500">animaux à l'adoption</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $adoptes }}</p>
                    <p class="text-sm text-gray-500">familles heureuses</p>
                </div>
            </div>
        </div>

        <div class="relative hidden lg:block">
            <div class="mx-auto flex h-80 w-80 items-center justify-center rounded-full bg-white shadow-xl">
                <span class="text-[10rem] leading-none">🐾</span>
            </div>
        </div>
    </div>
</section>
