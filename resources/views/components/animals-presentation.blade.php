@props([])

<section class="relative overflow-hidden bg-[#FBF4EC] px-8 py-16">

    <div class="pointer-events-none absolute -top-24 -right-24 h-96 w-96 rounded-full bg-[#C67C47]/10 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-32 -left-24 h-96 w-96 rounded-full bg-[#BC8451]/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl">
        <div class="grid items-center gap-12 lg:grid-cols-2">

            <div>
                <h2 class="mt-6 text-4xl font-bold text-gray-900 sm:text-5xl">
                    Trouvez le <span class="text-[#C67C47]">compagnon</span> qui vous attend
                </h2>

                <p class="mt-6 max-w-xl text-lg text-gray-600">
                    Chaque animal de notre refuge est suivi par notre équipe, sociabilisé et prêt à
                    rejoindre une famille aimante. Parcourez leurs fiches, filtrez selon vos envies
                    et laissez-vous guider par un coup de cœur.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-3 lg:grid-cols-1 xl:grid-cols-3">

                <div class="rounded-2xl border border-gray-200 bg-white p-5 text-center shadow-sm">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#C67C47]/10 text-[#C67C47]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <polyline stroke-linecap="round" stroke-linejoin="round" points="22 12 18 12 15 21 9 3 6 12 2 12" />
                        </svg>
                    </span>
                    <p class="mt-3 text-sm font-semibold text-gray-900">Suivi vétérinaire</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 text-center shadow-sm">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#C67C47]/10 text-[#C67C47]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            <polyline stroke-linecap="round" stroke-linejoin="round" points="9 12 11 14 15 10" />
                        </svg>
                    </span>
                    <p class="mt-3 text-sm font-semibold text-gray-900">Vaccinés & identifiés</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 text-center shadow-sm">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#C67C47]/10 text-[#C67C47]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                    </span>
                    <p class="mt-3 text-sm font-semibold text-gray-900">Sociabilisés avec amour</p>
                </div>

            </div>

        </div>
    </div>
</section>
