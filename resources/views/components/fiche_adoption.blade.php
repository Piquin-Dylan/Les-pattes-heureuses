<div class="min-h-screen bg-white px-4 py-6 sm:px-6 lg:py-8">

    <div class="mx-auto max-w-6xl">

        <a
            href="{{ route('adoptions') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-[#C67C47]">
            <span>←</span>
            Retour aux demandes
        </a>

        <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="mb-1 text-xs font-bold uppercase tracking-wide text-[#C67C47]">
                    Demande d'adoption
                </p>

                <h1 class="text-2xl font-bold text-[#171C2B] sm:text-3xl">
                    Détail de la demande
                </h1>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Consultez les informations de l'adoptant et de l'animal concerné.
                </p>
            </div>

            <span class="w-fit rounded-full bg-[#F6EDE6] px-4 py-2 text-xs font-bold text-[#A65F2F]">
                {{ $adoption->status }}
            </span>

        </div>

        <div
            class="grid grid-cols-1 items-start gap-6 lg:grid-cols-[16rem_minmax(0,1fr)] xl:grid-cols-[18rem_minmax(0,1fr)]">

            <aside class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm lg:sticky lg:top-6">

                <div class="flex aspect-[16/10] items-center justify-center bg-[#F4EEE9] lg:aspect-[4/3]">

                    @if($adoption->animal->photo)
                        <img
                            src="{{ asset('storage/' . $adoption->animal->photo) }}"
                            alt="{{ $adoption->animal->name }}"
                            class="h-full w-full object-cover"
                        >
                    @else
                        <span class="text-5xl text-[#D9BEA5]">
                            🐾
                        </span>
                    @endif

                </div>

                <div class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>
                            <p class="mb-1 text-[0.65rem] font-bold uppercase tracking-wide text-[#C67C47]">
                                Animal concerné
                            </p>

                            <h2 class="text-xl font-bold text-[#171C2B]">
                                {{ $adoption->animal->name }}
                            </h2>
                        </div>

                        <span
                            class="shrink-0 rounded-full bg-[#F4EEE9] px-3 py-1 text-[0.65rem] font-bold text-[#A8663A]">
                            {{ $adoption->animal->status }}
                        </span>

                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-2">

                        <div class="min-w-0 rounded-xl bg-gray-50 p-3">
                            <span class="block text-[0.65rem] text-gray-400">
                                Espèce
                            </span>

                            <strong class="mt-1 block break-words text-sm text-[#202534]">
                                {{ ucfirst($adoption->animal->species->value ?? $adoption->animal->species) }}
                            </strong>
                        </div>

                        <div class="min-w-0 rounded-xl bg-gray-50 p-3">
                            <span class="block text-[0.65rem] text-gray-400">
                                Sexe
                            </span>

                            <strong class="mt-1 block break-words text-sm text-[#202534]">
                                {{ ucfirst($adoption->animal->sex->value ?? $adoption->animal->sex) }}
                            </strong>
                        </div>

                        <div class="min-w-0 rounded-xl bg-gray-50 p-3">
                            <span class="block text-[0.65rem] text-gray-400">
                                Race
                            </span>

                            <strong class="mt-1 block break-words text-sm text-[#202534]">
                                {{ $adoption->animal->breed?->name ?? 'Non renseignée' }}
                            </strong>
                        </div>

                        <div class="min-w-0 rounded-xl bg-gray-50 p-3">
                            <span class="block text-[0.65rem] text-gray-400">
                                Âge
                            </span>

                            <strong class="mt-1 block break-words text-sm text-[#202534]">
                                {{ \Carbon\Carbon::parse($adoption->animal->age)->age }} ans
                            </strong>
                        </div>

                    </div>

                    <p class="mt-5 border-t border-gray-100 pt-5 text-sm leading-6 text-gray-500">
                        {{ $adoption->animal->description }}
                    </p>

                </div>

            </aside>

            <main class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-7 lg:p-8">

                <div class="border-b border-gray-100 pb-5">

                    <p class="mb-1 text-[0.7rem] font-bold uppercase tracking-wide text-[#C67C47]">
                        Informations de l'adoptant
                    </p>

                    <h2 class="text-xl font-bold text-[#171C2B] sm:text-2xl">
                        {{ $adoption->firstName }} {{ $adoption->lastName }}
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Informations communiquées lors de la demande d'adoption.
                    </p>

                </div>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div class="rounded-xl border border-[#EBE4DE] bg-[#FFFDFB] p-4">
                        <span class="block text-xs text-gray-400">
                            Prénom
                        </span>

                        <strong class="mt-1 block break-words text-sm text-[#202534]">
                            {{ $adoption->firstName }}
                        </strong>
                    </div>

                    <div class="rounded-xl border border-[#EBE4DE] bg-[#FFFDFB] p-4">
                        <span class="block text-xs text-gray-400">
                            Nom de famille
                        </span>

                        <strong class="mt-1 block break-words text-sm text-[#202534]">
                            {{ $adoption->lastName }}
                        </strong>
                    </div>

                    <div class="rounded-xl border border-[#EBE4DE] bg-[#FFFDFB] p-4">
                        <span class="block text-xs text-gray-400">
                            Adresse email
                        </span>

                        <strong class="mt-1 block break-all text-sm text-[#202534]">
                            {{ $adoption->email }}
                        </strong>
                    </div>

                    <div class="rounded-xl border border-[#EBE4DE] bg-[#FFFDFB] p-4">
                        <span class="block text-xs text-gray-400">
                            Numéro de téléphone
                        </span>

                        <strong class="mt-1 block break-words text-sm text-[#202534]">
                            {{ $adoption->phone }}
                        </strong>
                    </div>

                </div>

                <div class="mt-6">

                    <span class="mb-2 block text-xs font-bold text-[#353A49]">
                        Message de l'adoptant
                    </span>

                    <div
                        class="min-h-32 whitespace-pre-line break-words rounded-xl border border-gray-200 p-4 text-sm leading-7 text-gray-500">
                        {{ $adoption->message }}
                    </div>

                </div>

                <div
                    class="mt-6 grid grid-cols-1 gap-4 rounded-xl border border-[#EADED4] bg-[#FAF6F2] p-4 sm:grid-cols-2">

                    <div>
                        <span class="block text-xs text-gray-400">
                            Statut de la demande
                        </span>

                        <strong class="mt-1 block text-sm text-[#202534]">
                            {{ $adoption->status }}
                        </strong>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-400">
                            Demande envoyée le
                        </span>

                        <strong class="mt-1 block text-sm text-[#202534]">
                            {{ $adoption->created_at->format('d/m/Y à H:i') }}
                        </strong>
                    </div>

                </div>

            </main>

        </div>

    </div>

</div>
