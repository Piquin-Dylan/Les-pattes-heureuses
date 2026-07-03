@props([
    'member'
])

<div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

    <div class="relative flex flex-col items-center bg-gray-50 px-6 py-8">

        <span class="absolute left-4 top-4 rounded-full bg-[#C67C47] px-3 py-1 text-xs font-semibold text-white">
            {{ $member->status instanceof \BackedEnum ? $member->status->value : ucfirst($member->status) }}
        </span>

        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#C67C47] text-2xl font-bold text-white">
            {{ strtoupper(substr($member->firstName, 0, 1)) }}
            {{ strtoupper(substr($member->lastName, 0, 1)) }}
        </div>

        <h2 class="mt-4 text-center text-xl font-bold text-gray-900">
            {{ $member->firstName }} {{ $member->lastName }}
        </h2>

        <p class="mt-1 max-w-full truncate text-sm text-gray-500">
            {{ $member->email }}
        </p>

    </div>

    <div class="space-y-5 p-5">

        <div class="grid grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-400">
                    Téléphone
                </p>

                <p class="mt-1 font-medium text-gray-900">
                    {{ $member->phone ?? 'Non renseigné' }}
                </p>
            </div>

            <div>
                <p class="text-gray-400">
                    Statut
                </p>

                <p class="mt-1 font-medium text-gray-900">
                    {{ $member->status instanceof \BackedEnum ? $member->status->value : ucfirst($member->status) }}
                </p>
            </div>

        </div>

        <a
            href="{{ route('members.fiche', $member->id) }}"
            class="block rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">
            Voir la fiche
        </a>

    </div>

</div>
