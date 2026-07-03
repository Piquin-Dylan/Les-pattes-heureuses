@props([
    'member'
])

<div
    class="group overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="relative flex aspect-square items-center justify-center bg-gray-100">

        <div
            class="flex h-28 w-28 items-center justify-center rounded-full bg-[#C67C47] text-4xl font-bold text-white"
        >
            {{ strtoupper(substr($member->firstName, 0, 1)) }}
            {{ strtoupper(substr($member->lastName, 0, 1)) }}
        </div>

        <span
            class="absolute left-4 top-4 rounded-full bg-[#C67C47] px-3 py-1 text-xs font-semibold text-white">
            {{ ucfirst($member->status) }}
        </span>

    </div>

    <div class="space-y-4 p-5">

        <div>
            <h2 class="text-xl font-bold text-gray-900">
                {{ $member->firstName }} {{ $member->lastName }}
            </h2>

            <p class="text-sm text-gray-500">
                {{ $member->email }}
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-400">
                    Téléphone
                </p>

                <p class="font-medium text-gray-900">
                    {{ $member->phone ?? 'Non renseigné' }}
                </p>
            </div>

            <div>
                <p class="text-gray-400">
                    Statut
                </p>

                <p class="font-medium text-gray-900">
                    {{ ucfirst($member->status) }}
                </p>
            </div>

        </div>

        <a
            href="{{ route('members.show', $member->id) }}"
            class="block rounded-xl bg-[#C67C47] py-3 text-center font-semibold text-white transition hover:bg-[#b56f3c]">
            Voir la fiche
        </a>

    </div>
</div>
